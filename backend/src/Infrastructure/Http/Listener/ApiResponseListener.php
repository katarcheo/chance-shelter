<?php

namespace App\Infrastructure\Http\Listener;

use App\Infrastructure\Http\Resource\Resource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class ApiResponseListener
{
    public function __invoke(ViewEvent $event): void
    {
        $result = $event->getControllerResult();

        if ($result instanceof Resource) {
            $response = new JsonResponse([
                'data' => $result,
            ]);

            $event->setResponse($response);
        }
    }
}
