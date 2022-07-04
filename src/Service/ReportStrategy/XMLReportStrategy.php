<?php

namespace App\Service\ReportStrategy;

use App\Utils\TempFileHelperTrait;
use Symfony\Component\Filesystem\Filesystem;

class XMLReportStrategy implements ReportStrategyInterface
{
    use TempFileHelperTrait;

    public const REPORT_FORMAT = 'xml';

    public function __construct(protected readonly Filesystem $filesystem)
    {
    }

    public function generateReportFile(array $data): \SplFileInfo|string
    {
        $rootKey = array_key_first($data);

        return $this->createTempFile(
            $this->createXMLElement($data[$rootKey], $rootKey),
            'report_'
        );
    }

    protected function createXMLElement(array $entities, string $rootKey, \SimpleXMLElement $parentXml = null): bool|string
    {
        if ($parentXml === null) {
            $parentXml = new \SimpleXMLElement(
                sprintf('<?xml version="1.0"?><%1$s></%1$s>', $rootKey)
            );
        }

        foreach ($entities as $entity) {
            foreach ($entity as $key => $value) {
                if (is_array($value)) {
                    $this->createXMLElement($value, $key, $parentXml->addChild($key));
                } else {
                    $parentXml->addChild($key, $value);
                }
            }
        }

        return $parentXml->asXML();
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
