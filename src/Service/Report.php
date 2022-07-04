<?php

namespace App\Service;

use App\Repository\TeamRepository;

class Report
{
    public function __construct(
        protected readonly ReportDecisionManager $decisionManager,
        protected readonly TeamRepository $teamRepository
    )
    {
    }

    public function getReportFile(string $format): \SplFileInfo|string
    {
        return $this->decisionManager
            ->decide($format)
            ->generateReportFile($this->teamRepository->getAllTeamsWithRelatedAccounts());
    }
}
