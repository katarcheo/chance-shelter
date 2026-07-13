<?php

use App\Application\UseCases\JournalRecording\RecordExpense\CreateExpenseCommand;
use App\Application\UseCases\JournalRecording\RecordExpense\UploadedFileList;
use App\Tests\Support\Factories\Category\CategoryFactory;
use League\Flysystem\FilesystemOperator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

uses(
    KernelTestCase::class,
);

test('record expense command', function () {
    $storage = $this::getContainer()->get('default.storage');

    $category = CategoryFactory::new()->create();
    $command = new CreateExpenseCommand(
        amount:      123,
        description: 'test',
        categoryId:  $category->id(),
        media:       new UploadedFileList(makeUploadedFile('test_media')),
    );

});

function makeUploadedFile(string $name, string $content = 'test'): UploadedFile
{
    $file = tempnam(sys_get_temp_dir(), 'test_upload_');
    file_put_contents($file, $content);

    return new UploadedFile(
        path: $file,
        originalName: $name,
        test: true,
    );
}
