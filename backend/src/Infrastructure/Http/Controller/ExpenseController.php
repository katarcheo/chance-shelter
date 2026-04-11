<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\DTO\ExpenseDTO;
use App\Application\JournalRecordingService;
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
        JournalRecordingService $journal,
    ): Response
    {
        $journal->expense($expenseDTO);
        return new Response('successful', Response::HTTP_CREATED);
    }
}
