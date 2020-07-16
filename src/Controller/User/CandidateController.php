<?php

namespace App\Controller\User;

use App\Entity\Candidate;
use App\Entity\CurriculumVitae;
use App\Entity\Offer;
use App\Entity\Skill;
use App\Entity\User;
use App\Form\CurriculumVitaeType;
use App\Form\SkillType;
use App\Service\Questionnaire\QuestionnaireManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidat", name="candidate_")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show_profile")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function show(User $user, Request $request): Response
    {
        if (!$this->getUser()->getIsActive()) {
            return $this->redirectToRoute('index');
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            $curriculumVitae = new CurriculumVitae();
            $form = $this->createForm(CurriculumVitaeType::class, $curriculumVitae);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user->getCandidate()->setCurriculumVitae($curriculumVitae);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
            }
        }

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'form' => isset($form) ? $form->createView() : null
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

    /**
     * @Route("/nouvelle_competence", name="add_skill")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addSKill(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser()->getCandidate();
        $newSkill = new Skill();
        $form = $this->createForm(SkillType::class, $newSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSkill = $form->getData();
            $newSkill->setCandidate($user);

            $entityManager->persist($newSkill);
            $entityManager->flush();
        }

        return $this->render('/user/candidate/add_skill.html.twig', [
            'form' => $form->createView(),
            'skills' => $user->getSkills(),
        ]);
    }
}
