<?php

namespace App\Application;

use App\Domain\DateRange;
use App\Domain\Journal\JournalRepository;
use App\Domain\Report\ReportService;
use Carbon\CarbonImmutable;

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
