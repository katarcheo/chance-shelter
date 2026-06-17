<?php

use App\Domain\Category\CategoryRepository;
use App\Tests\Support\Factories\Category\CategoryFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

pest()->group('infrastructure');

uses(KernelTestCase::class);

test('dev', function () {
    $this::bootKernel();
    CategoryFactory::new()->create();
    $repo = $this::getContainer()->get(CategoryRepository::class);
});
