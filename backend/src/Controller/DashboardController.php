<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard_index')]
    public function index(
        Security $security,
    ): Response
    {
        return $this->render('dashboard.html.twig', [
            'user' => $security->getUser(),
        ]);
    }
}
