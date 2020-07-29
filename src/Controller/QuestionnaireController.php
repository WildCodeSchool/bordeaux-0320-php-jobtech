<?php

namespace App\Controller;

use App\Entity\Questionnaire;
use App\Form\QuestionnaireType;
use App\Repository\AbilityRepository;
use App\Service\Questionnaire\QuestionnaireManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidat", name="questionnaire_")
 */
class QuestionnaireController extends AbstractController
{
    public const PROFESSIONAL = 'professionnel';
    public const PERSONAL = 'personnel';

    /**
     * @Route("/questionnaire", name="index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('questionnaire/index.html.twig');
    }

    /**
     * @Route("/questionnaire/resultat/", name="result")
     * @return Response
     */
    public function result(): Response
    {
        return $this->render("questionnaire/result.html.twig");
    }

    /**
     * @Route("/questionnaire/{competence}", name="questionnaire")
     * @param string $competence
     * @param AbilityRepository $abilityRepository
     * @param QuestionnaireManager $questionnaireManager
     * @param Request $request
     * @return Response
     */
    public function questionnaire(
        string $competence,
        AbilityRepository $abilityRepository,
        QuestionnaireManager $questionnaireManager,
        Request $request
    ): Response {
        $abilities = [];
        if ($competence === self::PROFESSIONAL) {
            $abilities = $abilityRepository->findBy(['isProfessional' => true]);
        } elseif ($competence === self::PERSONAL) {
            $abilities = $abilityRepository->findBy(['isProfessional' => false]);
        }
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

            $path = 'questionnaire_result';
            $parameter = [];
            if ($competence === self::PERSONAL) {
                $path = 'questionnaire';
                $parameter = ['competence' => self::PROFESSIONAL];
            }
            return $this->redirectToRoute($path, $parameter);
        }

        return $this->render('questionnaire/questionnaire.html.twig', [
            'questions' => $form->createView(),
            'competence' => $competence
        ]);
    }
}
