<?php

namespace App\Service\ReportStrategy;

interface ReportStrategyInterface
{
    public static function getName(): string;

    public function generateReportFile(array $data): \SplFileInfo|string;

    public function supports(string $reportFormat): bool;
}
