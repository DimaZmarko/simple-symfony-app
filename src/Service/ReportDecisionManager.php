<?php

namespace App\Service;

use App\Service\ReportStrategy\ReportStrategyInterface;

class ReportDecisionManager
{
    public function __construct(protected readonly iterable $reportStrategies)
    {
    }

    public function decide(string $reportFormat): ReportStrategyInterface
    {
        foreach ($this->reportStrategies as $strategy) {
            if ($strategy->supports($reportFormat)) {
                return $strategy;
            }
        }

        throw new \RuntimeException('No strategy supports given ReportFormat');
    }
}
