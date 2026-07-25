<?php

use App\Application\UseCases\JournalRecording\RecordExpense\CreatedExpenseResult;
use App\Application\UseCases\JournalRecording\RecordExpense\CreateExpenseCommand;
use App\Application\UseCases\JournalRecording\RecordExpense\UploadedFileList;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use App\Tests\Support\Factories\Category\CategoryFactory;
use App\Tests\Support\Factories\Journal\BalanceFactory;
use App\Tests\Support\HasRepositories;
use League\Flysystem\FilesystemOperator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

uses(
    KernelTestCase::class,
    HasRepositories::class,
);

test('record expense command', function () {

    BalanceFactory::new()->create(['amount' => Money::kzt(1000)]);
    $command = new CreateExpenseCommand(
        amount:      123,
        description: 'test',
        categoryId:  CategoryFactory::new()->create()->id(),
        media:       new UploadedFileList(makeUploadedFile('test_media')),
    );

    /* @var $expense CreatedExpenseResult */
    $result = $this::getContainer()->get(MessageBusInterface::class)
        ->dispatch($command)
        ->last(HandledStamp::class)
        ->getResult();

    $expense = $this::getContainer()->get(JournalRepository::class);

    /* @var $storage FilesystemOperator*/
    $storage = $this::getContainer()->get('media.storage');
    $storage->fileExists($result->expense->getAttachedMedia()[0]);

});

function makeUploadedFile(string $name, string $content = 'test'): UploadedFile
{
    $file = tempnam(sys_get_temp_dir(), 'test_upload_');
    file_put_contents($file, $content);

    return new UploadedFile(
        path: $file,
        originalName: $name,
        mimeType: 'image/png',
        test: true,
    );
}
