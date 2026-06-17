<?php

use App\Domain\Category\CategoryRepository;
use App\Tests\Support\Factories\Category\CategoryFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

pest()->group('infrastructure');

uses(KernelTestCase::class);

beforeEach(function () {
    $this::bootKernel();

    $this->categoryRepo = $this::getContainer()->get(CategoryRepository::class);
});

test('isExistByName method', function () {
    $name = 'test_name_123';
    CategoryFactory::new()->create(['name' => $name]);

    expect($this->categoryRepo->isExistByName($name))->toBeTrue();
    expect($this->categoryRepo->isExistByName('other_name'))->toBeFalse();
});
