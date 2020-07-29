<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class CsvManager
{

    /**
     * @param array $data
     * @param string $filename
     * @param string $delimiter
     * @param string $enclosure
     * @return void
     */
    public function exportDataToCsv(array $data, $filename = 'export', $delimiter = ';', $enclosure = '"'): void
    {
        $fileOpen = fopen("php://output", 'wb');
        fwrite($fileOpen, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        fputcsv($fileOpen, array_values($data[0]), $delimiter, $enclosure);

        for ($i = 1, $iMax = count($data); $i < $iMax; $i++) {
            fputcsv($fileOpen, array_values($data[$i]), $delimiter, $enclosure);
        }

        fclose($fileOpen);
        $response = new Response();
        $response->headers->set('Content-disposition', 'attachment; filename="' . $filename . '.csv"');
        $response->headers->set('Content-type', 'text/csv');
        die;
    }

    /**
     * @param array $data
     * @return array
     */
    public function dataCandidateBeforeExport(array $data): array
    {
        $dataCandidateExport = [];
        $dataCandidateExport[] = [
            'Nom',
            'Prénom',
            'Email',
            'Téléphone',
            'Autre Numéro',
            'Date de création',
            'Ville',
            'Code Postal',
            'Pays',
            'Situation d\'handicape',
            'Contact Email',
            'Contact Téléphone',
        ];

        foreach ($data as $field) {
            $dataCandidateExport[] = [
                $field->getCandidate()->getSurname(),
                $field->getCandidate()->getFirstname(),
                $field->getEmail(),
                $field->getCandidate()->getFormattedPhoneNumber(),
                $field->getCandidate()->getFormattedOtherPhoneNumber(),
                $field->getCreatedAt()->format('d-m-Y H:i'),
                $field->getCandidate()->getCity(),
                $field->getCandidate()->getPostalCode(),
                $field->getCandidate()->getCountry(),
                $field->getCandidate()->getIsHandicapped(),
                $field->getCandidate()->getIsContactableEmail(),
                $field->getCandidate()->getIsContactableTel(),
            ];
        }
        return $dataCandidateExport;
    }

    /**
     * @param array $data
     * @return array
     */
    public function dataCompanyBeforeExport(array $data): array
    {

        $dataCompaniesExport = [];
        $dataCompaniesExport[] = [
            'Nom',
            'Siret',
            'Email',
            'Date de création',
            'Adresse',
            'Code postal',
            'Ville',
            'Pays',
        ];
        foreach ($data as $field) {
            $dataCompaniesExport[] = [
                $field->getCompany()->getName(),
                $field->getCompany()->getSiret(),
                $field->getEmail(),
                $field->getCreatedAt()->format('d-m-Y H:i'),
                $field->getCompany()->getAddress(),
                $field->getCompany()->getPostalCode(),
                $field->getCompany()->getCity(),
                $field->getCompany()->getCountry(),
            ];
        }
        return $dataCompaniesExport;
    }
}
