<?php

use League\Flysystem\FilesystemOperator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;

uses(
    KernelTestCase::class,
);

test('bus', function () {
    $this::getContainer()->get(MessageBusInterface::class);
    $storage = $this::getContainer()->get(FilesystemOperator::class);
});
