<?php

namespace App\Controller;

use App\Form\AboutType;
use App\Repository\JobCategoryRepository;
use App\Repository\NewsRepository;
use App\Repository\OfferRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobTechController extends AbstractController
{
    const MAX_JOB_CATEGORY_IN_INDEX = 10;
    const MAX_NEWS_IN_CAROUSEL = 3;
    const MAX_OFFER_IN_INDEX = 6;

    /**
     * @Route("/", name="index")
     * @param JobCategoryRepository $jobCategoryRepo
     * @param OfferRepository $offerRepository
     * @param NewsRepository $newsRepository
     * @return Response
     */
    public function index(
        JobCategoryRepository $jobCategoryRepo,
        OfferRepository $offerRepository,
        NewsRepository $newsRepository
    ): Response {
        return $this->render('index.html.twig', [
            'job_categories' => $jobCategoryRepo->getJobCategoryWithOffersNb(self::MAX_JOB_CATEGORY_IN_INDEX),
            'actualities' => $newsRepository->findBy([], ['postedAt' => 'DESC'], self::MAX_NEWS_IN_CAROUSEL),
            'offers' => $offerRepository->findAllOffersAndAddInterval(['postedAt' => 'DESC'], self::MAX_OFFER_IN_INDEX)
        ]);
    }

    /**
     * @Route("/about", name="about")
     * @return Response
     */
    public function about(Request $request)
    {
        $form = $this->createForm(AboutType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        return $this->render('about.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
