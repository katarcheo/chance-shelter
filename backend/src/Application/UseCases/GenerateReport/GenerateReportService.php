<?php

namespace App\Application\UseCases\GenerateReport;

use App\Domain\DateRange;
use App\Domain\Journal\JournalRepository;
use App\Domain\Report\ReportService;
use Carbon\CarbonImmutable;

class GenerateReportService
{
    public function __construct(
        private JournalRepository $journalRepo,
        private ReportService $reportService,
    )
    {}

//    public function byCurrentMonth(): File
    public function byCurrentMonth()
    {
        $now = new CarbonImmutable();
        $start = $now->startOfMonth();

        $this->journalRepo->getIncomesByPeriod(new DateRange($start, $now));

        dump($start);
    }
}
