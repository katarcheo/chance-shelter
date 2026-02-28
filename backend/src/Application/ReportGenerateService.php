<?php

namespace App\Application;

use App\Application\Repository\JournalRepository;
use App\Domain\DateRange;
use App\Domain\Report\ReportService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Symfony\Component\HttpFoundation\File\File;

class ReportGenerateService
{
    public function __construct(
        private JournalRepository $journalRepository,
        private ReportService $reportService,
    )
    {}

//    public function byCurrentMonth(): File
    public function byCurrentMonth()
    {
        $now = new CarbonImmutable();
        $start = $now->startOfMonth();

        $this->journalRepository->getIncomesByPeriod(new DateRange($start, $now));

        dump($start);
    }
}
