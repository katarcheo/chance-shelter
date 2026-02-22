<?php

namespace App\Domain;

use Domain\ValueObject\Report;

class Reporter
{
    public function __construct(private Journal $journal)
    {}

    public function getReportByCurrentMonth(): Report
    {
        return $this->getReportByPeriod(
//            TODO: current moth
        );
    }

    public function getReportByYear(int $year):  Report
    {
        return $this->getReportByPeriod(
//            TODO: year
        );
    }

    public function getReportByPeriod(\DateTime $from,  \DateTime $to): Report
    {

    }
}
