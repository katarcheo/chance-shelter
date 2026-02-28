<?php

namespace  App\Application;

use App\Application\DTO\AddCategoryDTO;
use App\Application\DTO\DTOException;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\Category;
use App\Domain\Repository\CategoryRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddCategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private ValidatorInterface $validator,
    )
    {}

    public function add(AddCategoryDTO $categoryData): void
    {
        $violations = $this->validator->validate($categoryData);

        if ($violations->count()) {
            throw new DTOException('Category data is invalid')->setViolations($violations);
        }

        if ($this->categoryRepository->isExistByName($categoryData->name)) {
            throw new ApplicationException('Category already exists');
        }

        $this->categoryRepository->add(new Category(
            id: Uuid::generate(),
            name: $categoryData->name,
        ));
    }
}
