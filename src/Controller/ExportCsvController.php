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
     * @return Response
     */
    public function exportCandidateCsv(UserRepository $userRepository, CsvExport $csvExport): Response
    {

        $candidates = $userRepository->findAllCandidate();
        $candidatesForExport = $csvExport->dataCandidateBeforeExport($candidates);
        $csvExport->exportDataToCsv($candidatesForExport);
        // redirect ne marche pas
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("companies", name="companies")
     * @param UserRepository $userRepository
     * @param CsvExport $csvExport
     * @return RedirectResponse
     */
    public function exportCompanyCsv(UserRepository $userRepository, CsvExport $csvExport)
    {
        $companies = $userRepository->findAllCompany();
        $companiesForExport = $csvExport->dataCompanyBeforeExport($companies);
        $csvExport->exportDataToCsv($companiesForExport);
        return $this->redirectToRoute('index');
    }
}
