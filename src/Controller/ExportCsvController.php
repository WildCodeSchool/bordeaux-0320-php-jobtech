<?php


namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\CsvExport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExportCsvController
 * @package App\Controller
 * @Route ("/csv", name="csv_")
 */
class ExportCsvController extends AbstractController
{
    /**
     * @Route("/candidates", name="candidates")
     * @param UserRepository $userRepository
     * @param CsvExport $csvExport
     */
    public function exportCandidateCsv(UserRepository $userRepository, CsvExport $csvExport): void
    {
        $candidates = $userRepository->findAllCandidate();
        $candidatesForExport = $csvExport->dataCandidateBeforeExport($candidates);
        $csvExport->exportDataToCsv($candidatesForExport);
    }

    /**
     * @Route("companies", name="companies")
     * @param UserRepository $userRepository
     * @param CsvExport $csvExport
     */
    public function exportCompanyCsv(UserRepository $userRepository, CsvExport $csvExport): void
    {
        $companies = $userRepository->findAllCompany();
        $companiesForExport = $csvExport->dataCompanyBeforeExport($companies);
        $csvExport->exportDataToCsv($companiesForExport);
    }
}
