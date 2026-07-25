<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\UseCases\JournalRecording\RecordExpense\CreateExpenseCommand;
use App\Domain\Ident;
use App\Domain\Media\MediaList;
use App\Infrastructure\Http\DTO\ExpenseResourceDTO;
use App\Infrastructure\Http\Requests\CreateExpenseRequest;
use App\Tests\Application\UseCases\Media\RecordUploadedMediaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class JournalController extends AbstractController
{
    use HandleTrait;

    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    #[Route('/expense/create', name: 'expense_create', methods: ['GET'])]
    public function create(): Response
    {
        return $this->render('expense/create.html.twig', [
            'controller_name' => 'ExpenseController',
        ]);
    }

    #[Route('/expense/create', name: 'expense_store', methods: ['POST'])]
    public function store(
        #[MapRequestPayload] CreateExpenseRequest $request,
        RecordUploadedMediaService                $recordAttachment,
    ): ExpenseResourceDTO
    {
        $mediaRefs = array_map(
            fn(UploadedFile $file) => $recordAttachment($file, 'expense')->mediaRef(),
            $request->attachments,
        );

        $command = new CreateExpenseCommand(
            amount: $request->amount,
            description: $request->description,
            categoryId: Ident::from($request->categoryId),
            attachments: new MediaList(...$mediaRefs),
        );

        $expense = $this->handle($command);

        return ExpenseResourceDTO::from($expense);
    }
}
