<?php

namespace App\Controller\User;

use App\Entity\Offer;
use App\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entreprise", name="company_")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/offres/{id}", name="show_offer")
     * @param Offer $offer
     * @return Response
     */
    public function showOffer(Offer $offer): Response
    {
        return $this->render('user/company/show_offer.html.twig', [
            'offer' => $offer
        ]);
    }

    /**
     * @Route("/offres/edit/{id}", name="edit_offer")
     * @param Offer $offer
     * @param Request $request
     * @return Response
     */
    public function editOffer(Offer $offer, Request $request): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('company_show_offer', ['id' => $offer->getId()]);
        }

        return $this->render('user/company/_edit_company_offer.html.twig', ['form' => $form->createView()]);
    }
}
