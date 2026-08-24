<?php

namespace  App\Application\UseCases\AddCategory;

use App\Application\Exceptions\ValidationException;
use App\Application\ValidateCommand;
use App\Domain\Category\Category;
use App\Domain\Category\CategoryRepository;
use App\Domain\Ident;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class AddCategory
{
    public function __construct(
        private CategoryRepository $categoryRepo,
    )
    {}

    /**
     * @throws ValidationException|CategoryAlreadyExists
    */
    public function __invoke(AddCategoryCommand $categoryData, ValidateCommand $validate): CreatedCategoryResult
    {
        $validate($categoryData, 'Category data is invalid');

        if ($this->categoryRepo->isExistByName($categoryData->name)) {
            throw new CategoryAlreadyExists();
        }

        $category = new Category(
            id: Ident::new(),
            name: $categoryData->name,
        );

        $this->categoryRepo->create($category);

        return new CreatedCategoryResult(
            id: $category->id(),
        );
    }
}
