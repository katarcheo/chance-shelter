<?php

use App\Domain\Category\CategoryRepository;
use App\Tests\Support\Factories\Category\CategoryFactory;
use App\Tests\Support\HasRepositories;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

pest()->group('infrastructure');

uses(
    KernelTestCase::class,
    HasRepositories::class,
);

beforeEach(function () {
    $this::bootKernel();

    /* @var CategoryRepository $repo */
    $repo = $this::getContainer()->get(CategoryRepository::class);
    $this->categoryRepo = $repo;
});

test('isExistByName method', function () {
    $name = 'test_name_123';
    CategoryFactory::new()->create(['name' => $name]);

    expect($this->categoryRepo->isExistByName($name))->toBeTrue();
    expect($this->categoryRepo->isExistByName('other_name'))->toBeFalse();
});
