<?php

namespace App\Service\ReportStrategy;

use App\Utils\TempFileHelperTrait;
use Symfony\Component\Filesystem\Filesystem;

class JsonReportStrategy implements ReportStrategyInterface
{
    use TempFileHelperTrait;

    public const REPORT_FORMAT = 'json';

    public function __construct(protected readonly Filesystem $filesystem)
    {
    }

    public function generateReportFile(array $data): \SplFileInfo|string
    {
        return $this->createTempFile(
            json_encode($data, JSON_THROW_ON_ERROR),
            'report_'
        );
    }

    public static function getName(): string
    {
        return sprintf('%s_report', self::REPORT_FORMAT);
    }

    public function supports(string $reportFormat): bool
    {
        return $reportFormat === self::REPORT_FORMAT;
    }
}
