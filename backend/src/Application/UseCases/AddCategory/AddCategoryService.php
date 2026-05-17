<?php

namespace  App\Application\UseCases\AddCategory;

use App\Application\UseCases\Exceptions\ApplicationException;
use App\Application\UseCases\Exceptions\DTOException;
use App\Domain\Category\Category;
use App\Domain\Category\CategoryRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddCategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepo,
        private ValidatorInterface $validator,
    )
    {}

    public function __invoke(AddCategoryDTO $categoryData): void
    {
        $violations = $this->validator->validate($categoryData);

        if ($violations->count()) {
            throw new DTOException('Category data is invalid')->setViolations($violations);
        }

        if ($this->categoryRepo->isExistByName($categoryData->name)) {
            throw new ApplicationException('Category already exists');
        }

        $this->categoryRepo->save(new Category(
            name: $categoryData->name,
        ));
    }
}
