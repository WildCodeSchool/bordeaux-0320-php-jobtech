<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\QuestionnaireType;
use App\Entity\Questionnaire;
use App\Repository\AbilityRepository;
use App\Repository\QuestionnaireRepository;
use App\Service\Questionnaire\QuestionnaireManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionnaireController extends AbstractController
{
    /**
     * @Route("/questionnaire", name="questionnaire")
     * @param AbilityRepository $abilityRepository
     * @param QuestionnaireManager $questionnaireManager
     * @param Request $request
     * @return Response
     */
    public function index(
        AbilityRepository $abilityRepository,
        QuestionnaireManager $questionnaireManager,
        Request $request
    ) {
        $abilities = $abilityRepository->findAll();
        $questions = $questionnaireManager->getQuestions($abilities);

        $form = $this->createForm(QuestionnaireType::class, null, ['questions' => $questions]);
        $form->handleRequest($request);

        if ($form->isSubmitted() &&
            $form->isValid() &&
            $questionnaireManager->isCorrectAbilities($abilities, $form->getData())) {
            $entityManager = $this->getDoctrine()->getManager();
            $result = $questionnaireManager->calculateAbilities($form->getData(), $abilities);
            foreach ($result as $ability => $score) {
                $questionnaire = new Questionnaire();
                $questionnaire->setCandidate($this->getUser()->getCandidate())
                    ->setAbility($abilityRepository->find($ability))
                    ->setScore($score);
                $entityManager->persist($questionnaire);
            }
            $entityManager->flush();

            $this->redirectToRoute('profile');
        }

        return $this->render('questionnaire/index.html.twig', [
            'questions' => $form->createView(),
        ]);
    }

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
            'pro' => $data['pro'],
            'perso' => $data['perso'],
            'date' => $data['postedAt']
        ]);
    }
}
