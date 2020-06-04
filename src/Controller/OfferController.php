<?php


namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/offer", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function list(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findByAndAddInterval([], ['createdOn'=>'DESC'], 9);

        if (!$offers) {
            throw $this->createNotFoundException(
                'No offers found in offer table.'
            );
        }

        return $this->render('offer/list.html.twig', [
            'offers' => $offers,
        ]);
    }
}
