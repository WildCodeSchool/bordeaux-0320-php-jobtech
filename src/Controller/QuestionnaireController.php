<?php

namespace App\Controller;

use App\Form\QuestionnaireType;
use App\Repository\AbilityRepository;
use App\Service\Questionnaire\QuestionnaireManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionnaireController extends AbstractController
{
    const NB_OF_QUESTIONS_BY_ABILITY = 10;

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
        $questions = $questionnaireManager->getQuestions($abilities, self::NB_OF_QUESTIONS_BY_ABILITY);

        $form = $this->createForm(QuestionnaireType::class, null, ['questions' => $questions]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($questionnaireManager->calculateAbilities($form->getData()));
        }

        return $this->render('questionnaire/index.html.twig', [
            'questions' => $form->createView(),
        ]);
    }
}
