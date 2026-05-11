<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\UseCases\RecordExpense\RecordExpenseService;
use App\Application\UseCases\RecordExpense\ExpenseDTO;

use App\Infrastructure\Http\ApiResponse;
use App\Infrastructure\Http\DTO\ExpenseResourceDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class ExpenseController extends AbstractController
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
        #[MapRequestPayload] ExpenseDTO $expenseDTO,
        RecordExpenseService $journal,
    ): ExpenseResourceDTO
    {
        $expense = $journal->expense($expenseDTO);

        return ExpenseResourceDTO::from($expense);
    }
}
