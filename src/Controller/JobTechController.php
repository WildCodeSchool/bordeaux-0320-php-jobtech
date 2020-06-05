<?php

namespace App\Controller;

use App\Repository\JobCategoryRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobTechController extends AbstractController
{
    const MAX_OFFER = 6;

    /**
     * @Route("/", name="index")
     * @param JobCategoryRepository $jobCategoryRepo
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function index(JobCategoryRepository $jobCategoryRepo, OfferRepository $offerRepository): Response
    {
        return $this->render('job_tech/index.html.twig', [
            'job_categories' => $jobCategoryRepo->findAll(),
            'offers' => $offerRepository->findBy([], ['createdOn' => 'DESC'], self::MAX_OFFER)
        ]);
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function registration(): Response
    {
        return $this->render('job_tech/registration.html.twig');
    }
}
