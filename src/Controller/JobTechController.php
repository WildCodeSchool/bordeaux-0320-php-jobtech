<?php

namespace App\Controller;

use App\Repository\JobCategoryRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobTechController extends AbstractController
{
    const MAX_JOB_CATEGORY_IN_INDEX = 10;
    const MAX_OFFER_IN_INDEX = 6;

    /**
     * @Route("/", name="index")
     * @param JobCategoryRepository $jobCategoryRepo
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function index(JobCategoryRepository $jobCategoryRepo, OfferRepository $offerRepository): Response
    {
        return $this->render('index.html.twig', [
            'job_categories' => $jobCategoryRepo->getJobCategoryWithOffersNb(self::MAX_JOB_CATEGORY_IN_INDEX),
            'offers' => $offerRepository->findByAndAddInterval([], ['createdAt' => 'DESC'], self::MAX_OFFER_IN_INDEX)
        ]);
    }
}
