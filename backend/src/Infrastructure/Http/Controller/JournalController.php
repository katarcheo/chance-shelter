<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\UseCases\JournalRecording\RecordExpense\CreateExpenseCommand;
use App\Application\UseCases\JournalRecording\RecordExpense\RecordExpenseService;
use App\Infrastructure\Http\DTO\ExpenseResourceDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class JournalController extends AbstractController
{
    #[Route('/expense/create', name: 'expense_create', methods: ['GET'])]
    public function create(): Response
    {
        return $this->render('expense/create.html.twig', [
            'controller_name' => 'ExpenseController',
        ]);
    }

    #[Route('/expense/create', name: 'expense_store', methods: ['POST'])]
    public function store(
        #[MapRequestPayload] CreateExpenseCommand $expenseDTO,
        RecordExpenseService                      $recordExpense,
    ): ExpenseResourceDTO
    {
        $expense = $recordExpense($expenseDTO);

        return ExpenseResourceDTO::from($expense);
    }
}
