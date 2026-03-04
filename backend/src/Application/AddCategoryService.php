<?php

namespace  App\Application;

use App\Application\DTO\AddCategoryDTO;
use App\Application\DTO\DTOException;
use App\Application\Exceptions\ApplicationException;
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

    public function add(AddCategoryDTO $categoryData): void
    {
        $violations = $this->validator->validate($categoryData);

        if ($violations->count()) {
            throw new DTOException('Category data is invalid')->setViolations($violations);
        }

        if ($this->categoryRepo->isExistByName($categoryData->name)) {
            throw new ApplicationException('Category already exists');
        }

        $this->categoryRepo->add(new Category(
            id: Uuid::generate(),
            name: $categoryData->name,
        ));
    }
}
