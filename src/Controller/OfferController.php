<?php


namespace App\Controller;

use App\Form\SearchForm;
use App\Repository\OfferRepository;
use App\Service\OfferSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/offer", name="offer_")
 */
class OfferController extends AbstractController
{
    const MAX_OFFER_PER_PAGE = 9;

    /**
     * @Route("/", name="list")
     * @param OfferRepository $offerRepository
     * @param Request $request
     * @return Response
     */
    public function list(OfferRepository $offerRepository, Request $request): Response
    {
        $offers = $offerRepository->findByAndAddInterval([], ['createdAt'=>'DESC'], self::MAX_OFFER_PER_PAGE);

        if (!$offers) {
            throw $this->createNotFoundException(
                'No offers found in offer table.'
            );
        }

        $criteria = new OfferSearch();
        $form = $this->createForm(SearchForm::class, $criteria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offers = $offerRepository->findSearch($criteria);
        }

        return $this->render('job_tech/offer/list.html.twig', [
            'offers' => $offers,
            'form'   => $form->createView(),
        ]);
    }
}
