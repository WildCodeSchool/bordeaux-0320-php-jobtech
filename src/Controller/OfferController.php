<?php


namespace App\Controller;

use App\Entity\Apply;
use App\Entity\Offer;
use App\Entity\Search\OfferSearch;
use App\Form\OfferType;
use App\Form\SearchForm;
use App\Repository\OfferRepository;
use App\Service\Paginator;
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
        $offer = new Offer();
        $form =$this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $offer->setCompany($user->getCompany());
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('offer/new.html.twig', [
            'offer' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="list")
     * @param OfferRepository $offerRepository
     * @param Request $request
     * @param Paginator $paginator
     * @return Response
     */
    public function list(OfferRepository $offerRepository, Request $request, Paginator $paginator): Response
    {
        $offers = $offerRepository->findAllOffersAndAddInterval(['postedAt'=>'DESC']);

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

        $offers = $paginator->paging($offers, self::MAX_OFFER_PER_PAGE);

        return $this->render('offer/list.html.twig', [
            'offers' => $offers,
            'nb_offers' => $offerRepository->getTotalOfOffers(),
            'form'   => $form->createView(),
        ]);
    }

    /**
     * @Route("/bookmark", name="bookmark")
     * @return Response
     */
    public function bookmark(): Response
    {
        $offers = $this->getUser()->getCandidate()->getBookmarks();
        foreach ($offers as $offer) {
            $offer->setInterval();
        }

        return $this->render('offer/bookmark.html.twig', [
            'bookmarks' => $offers
        ]);
    }

    /**
     * @Route("/apply/{id}", name="apply")
     * @param Offer $offer
     * @param EntityManagerInterface $entityManager
     */

    public function applyOffer(Offer $offer, EntityManagerInterface $entityManager)
    {
        $apply = new Apply();
        $apply->setOffer($offer);
        $apply->setUser($this->getUser()->getCandidate());
        $entityManager->persist($apply);
        $entityManager->flush();
    }
}
