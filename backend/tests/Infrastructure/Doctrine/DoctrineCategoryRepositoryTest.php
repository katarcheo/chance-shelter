<?php

use App\Domain\Category\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

pest()->group('infrastructure');

uses(KernelTestCase::class);

test('dev', function () {
    $this::bootKernel();
    $repo = $this::getContainer()->get(CategoryRepository::class);
    dump($repo);
});
