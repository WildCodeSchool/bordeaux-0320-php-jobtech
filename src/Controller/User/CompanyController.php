<?php

namespace App\Controller\User;

use App\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
