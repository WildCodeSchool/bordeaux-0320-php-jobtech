<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\JobCategoryRepository;
use App\Repository\NewsRepository;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/footer/{page}/edit", name="footer_page_edit")
     * @param Request $request
     * @param Content $content
     * @ParamConverter("content", options={"mapping":{"page":"identifier"}})
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function footerPageEdit(Request $request, Content $content, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContentType::class, $content);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $content = $form->getData();

            $entityManager->persist($content);

            $entityManager->flush();
        }

        return $this->render('footer/page_footer_edit.html.twig', [
            'form' => $form->createView(),
            'content' => $content,
        ]);
    }

    /**
     * @Route("/footer/{page}", name="footer_page", methods={"GET"})
     * @ParamConverter("content", options={"mapping":{"page":"identifier"}})
     * @param Content $content
     * @return Response
     */
    public function footerPage(Content $content): Response
    {
        return $this->render('footer/page_footer.html.twig', [
            'content' => $content,
        ]);
    }
}
