<?php

namespace App\Controller\User;

use App\Entity\Candidate;
use App\Entity\CurriculumVitae;
use App\Entity\Experience;
use App\Entity\JobCategory;
use App\Entity\Offer;
use App\Entity\Search;
use App\Entity\Skill;
use App\Form\ExperienceType;
use App\Form\SearchJobType;
use App\Form\SkillType;
use App\Form\User\CurriculumVitaeType;
use App\Service\ArrayManager;
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
     * @param Candidate $candidate
     * @param Request $request
     * @return Response
     */
    public function show(Candidate $candidate, Request $request): Response
    {
        $user = $candidate->getUser();
        if ($this->isGranted('ROLE_ADMIN')) {
            $curriculumVitae = $candidate->getCurriculumVitae();
            $newCV = new CurriculumVitae();
            $newCV->setCandidate($candidate);
            $form = $this->createForm(CurriculumVitaeType::class, $newCV);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
            }
        }

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'form' => isset($form) ? $form->createView() : null,
            'cv' => $curriculumVitae ?? null
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

    /**
     * @Route("/competence/{id}", name="delete_skill", methods={"DELETE"})
     * @param Skill $skill
     * @param Request $request
     * @return Response
     */
    public function deleteSkill(Skill $skill, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($skill);
            $manager->flush();
        }

        return $this->redirectToRoute('candidate_add_skill');
    }

    /**
     * @Route ("/metier_rechercher", name="add_search_job")
     * @param Request $request
     * @return Response
     */
    public function addSearchJob(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $jobCategoryRepo = $this->getDoctrine()->getRepository(JobCategory::class);
            $jobs = $jobCategoryRepo->find($request->get('jobCategory'))->getJobs();
            $jobs = ArrayManager::prepareJobsForSelect($jobs->toArray());
            return $this->json($jobs);
        }

        $search = new Search();
        $form = $this->createForm(SearchJobType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $search->setCandidate($this->getUser()->getCandidate());
            $manager->persist($search);
            $manager->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/candidate/search_job.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/metier_rechercher/edit", name="edit_search_job")
     * @param Request $request
     * @return Response
     */
    public function editSearchJob(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $jobCategoryRepo = $this->getDoctrine()->getRepository(JobCategory::class);
            $jobs = $jobCategoryRepo->find($request->get('jobCategory'))->getJobs();
            $jobs = ArrayManager::prepareJobsForSelect($jobs->toArray());
            return $this->json($jobs);
        }

        $form = $this->createForm(SearchJobType::class, $this->getUser()->getCandidate()->getSearch());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/candidate/search_job.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/experience", name="add_experience")
     * @param Request $request
     * @return Response
     */
    public function addExperience(Request $request): Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $experience->setCandidate($this->getUser()->getCandidate());
            $manager->persist($experience);
            $manager->flush();
        }

        return $this->render('user/candidate/experience.html.twig', [
            'form' => $form->createView(),
            'experiences' => $this->getUser()->getCandidate()->getExperiences()
        ]);
    }

    /**
     * @Route("/experience/edit/{id}", name="edit_experience")
     * @param Experience $experience
     * @param Request $request
     * @return Response
     */
    public function editExperience(Experience $experience, Request $request): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('candidate_add_experience');
        }

        return $this->render('user/candidate/experience.html.twig', ['form' => $form->createView()]);
    }
}
