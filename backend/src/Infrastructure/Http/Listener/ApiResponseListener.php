<?php

namespace App\Infrastructure\Http\Listener;

use App\Infrastructure\Http\DTO\ApiResponseDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class ApiResponseListener
{
    public function __invoke(ViewEvent $event): void
    {
        $result = $event->getControllerResult();

        if ($result instanceof ApiResponseDTO) {
            $response = new JsonResponse([
                'data' => $result,
            ]);

            $event->setResponse($response);
        }
    }
}
