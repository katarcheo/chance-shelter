<?php

namespace App\Infrastructure\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct(string $string, int $HTTP_CREATED)
    {
        parent::__construct();
    }
}
