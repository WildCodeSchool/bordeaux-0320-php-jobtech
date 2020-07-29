<?php


namespace App\Controller;

use App\Entity\Apply;
use App\Entity\Offer;
use App\Entity\Search\OfferSearch;
use App\Form\OfferType;
use App\Form\SearchOfferType;
use App\Repository\OfferRepository;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route (name="offer_")
 */
class OfferController extends AbstractController
{
    public const MAX_OFFER_PER_PAGE = 9;

    /**
     * @Route("/offres", name="list")
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
        $form = $this->createForm(SearchOfferType::class, $criteria);
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
     * @Route("/entreprise/offres/nouvelle", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getIsActive() === false) {
            return $this->redirectToRoute('index');
        }

        $offer = new Offer();
        $form =$this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $offer->setCompany($user->getCompany());
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('offer_show', ['id' => $offer->getId()]);
        }

        return $this->render('offer/new.html.twig', [
            'offer' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entreprise/offres/{id}/edit", name="edit")
     * @param Offer $offer
     * @param Request $request
     * @return Response
     */
    public function edit(Offer $offer, Request $request): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('offer_show', ['id' => $offer->getId()]);
        }

        return $this->render('offer/new.html.twig', ['offer' => $form->createView()]);
    }

    /**
     * @Route("entreprise/offres/{id}", name="show")
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show_offer.html.twig', [
            'offer' => $offer
        ]);
    }

    // todo send Http code response if apply fail
    /**
     * @Route("/candidat/offres/{id}/candidater", name="apply")
     * @param Offer $offer
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function applyOffer(Offer $offer, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getIsActive() === false) {
            return $this->redirectToRoute('index');
        }

        $candidate = $this->getUser()->getCandidate();
        if ($candidate->haveApply($offer)) {
            return $this->json(null, 304);
        }

        $apply = new Apply();
        $apply->setOffer($offer);
        $apply->setUser($candidate);
        $entityManager->persist($apply);
        $entityManager->flush();

        return $this->json(null, 204);
    }
}
