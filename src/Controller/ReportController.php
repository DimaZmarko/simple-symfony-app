<?php

namespace App\Controller;

use App\Service\Report;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ReportController extends AbstractController
{
    #[Route('/api/report/{reportFormat}', name: 'get_report', methods: ['GET'])]
    public function index(
        Report $report,
        string $reportFormat
    ): Response
    {
        try {
            return $this->file($report->getReportFile($reportFormat));
        } catch (\Throwable $exception) {
            return $this->render(
                'report/index.html.twig',
                [
                    'error_message' => $exception->getMessage(),
                ]
            );
        }
    }
}
