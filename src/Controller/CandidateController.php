<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Offer;
use App\Service\Questionnaire\QuestionnaireManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidat", name="candidate_")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/getData/{id}", name="get_data_chart")
     * @param Candidate $candidate
     * @param QuestionnaireManager $questionnaireManager
     * @return JsonResponse
     */
    public function getDataForChart(Candidate $candidate, QuestionnaireManager $questionnaireManager): JsonResponse
    {
        $data = $candidate->getQuestionnaires()->toArray();
        $data = $questionnaireManager->prepareDataForChart($data);

        return new JsonResponse([
            'pro' => $data['pro']?? null,
            'perso' => $data['perso']?? null,
            'date' => $data['postedAt']
        ]);
    }

    /**
     * @Route("/{id}/favoris", name="add_bookmark")
     * @param Offer $offer
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function addToBookmark(Offer $offer, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $this->getUser()->getCandidate();

        $user->isBookmarked($offer) ? $user->removeBookmark($offer) : $user->addBookmark($offer);

        $entityManager->flush();

        return new JsonResponse(
            $this->getUser()->getCandidate()->isBookmarked($offer)
        );
    }
}
