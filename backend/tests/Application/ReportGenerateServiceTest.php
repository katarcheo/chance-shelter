<?php

namespace App\Tests\Application;

use App\Application\ReportGenerateService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReportGenerateServiceTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $service = static::getContainer()->get(ReportGenerateService::class);

        $service->byCurrentMonth();
    }
}
