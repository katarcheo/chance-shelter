<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\UseCases\AddCategory\AddCategoryCommand;
use App\Infrastructure\Http\Resource\CreatedCategoryResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    use HandleTrait;
    public function __construct(
        private MessageBusInterface $messageBus,
    )
    {
    }

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category', name: 'store_category', methods: ['POST'])]
    public function store(
        #[MapRequestPayload] AddCategoryCommand $command,
    ): CreatedCategoryResource
    {
        return CreatedCategoryResource::from($this->handle($command));
    }
}
