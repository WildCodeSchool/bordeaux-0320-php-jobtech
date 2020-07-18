<?php


namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\CsvManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @param CsvManager $csvExport
     */
    public function exportCandidateCsv(UserRepository $userRepository, CsvManager $csvExport): void
    {
        $candidates = $userRepository->findAllCandidate();
        $candidatesForExport = $csvExport->dataCandidateBeforeExport($candidates);
        $csvExport->exportDataToCsv($candidatesForExport);
    }

    /**
     * @Route("companies", name="companies")
     * @param UserRepository $userRepository
     * @param CsvManager $csvExport
     */
    public function exportCompanyCsv(UserRepository $userRepository, CsvManager $csvExport): void
    {
        $companies = $userRepository->findAllCompany();
        $companiesForExport = $csvExport->dataCompanyBeforeExport($companies);
        $csvExport->exportDataToCsv($companiesForExport);
    }
}
