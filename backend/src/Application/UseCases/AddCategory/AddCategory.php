<?php

namespace  App\Application\UseCases\AddCategory;

use App\Domain\Category\CategoryAlreadyExists;
use App\Domain\Category\Category;
use App\Domain\Category\CategoryNameIsFree;
use App\Domain\Category\CategoryRepository;
use App\Domain\Ident;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class AddCategory
{
    public function __construct(
        private CategoryRepository $categoryRepo,
        private CategoryNameIsFree $categoryAvailability,
    )
    {}

    /**
     * @throws CategoryAlreadyExists
    */
    public function __invoke(AddCategoryCommand $categoryData): CreatedCategoryResult
    {
        $category = Category::create(
            id: Ident::new(),
            name: $categoryData->name,
            availability: $this->categoryAvailability,
        );

        $this->categoryRepo->create($category);

        return new CreatedCategoryResult(
            id: $category->id(),
        );
    }
}
