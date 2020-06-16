<?php


namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Form\SearchForm;
use App\Repository\Api\GeoApiFrGov;
use App\Repository\OfferRepository;
use App\Service\OfferSearch;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/new", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form =$this->createForm(OfferType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offer = new Offer();
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('offer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/", name="list")
     * @param OfferRepository $offerRepository
     * @param Request $request
     * @return Response
     */
    public function list(OfferRepository $offerRepository, Request $request): Response
    {
        $offers = $offerRepository->findAllOffersAndAddInterval(['createdAt'=>'DESC'], self::MAX_OFFER_PER_PAGE);

        if (!$offers) {
            throw $this->createNotFoundException(
                'No offers found in offer table.'
            );
        }

        $criteria = new OfferSearch();
        $form = $this->createForm(SearchForm::class, $criteria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offers = $offerRepository->findSearch($criteria, $offers);
        }

        return $this->render('offer/list.html.twig', [
            'offers' => $offers,
            'nb_offers' => $offerRepository->getTotalOfOffers(),
            'form'   => $form->createView(),
        ]);
    }
}
