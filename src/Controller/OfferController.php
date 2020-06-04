<?php


namespace App\Controller;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use App\Service\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * Class OfferController
 * @package App\Controller
 * @Route ("/offer", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function showOffer(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findByAndAddInterval([], ['createdOn'=>'DESC'], 9);

        if (!$offers) {
            throw $this->createNotFoundException(
                'Aucune offre trouvée dans la table des offres.'
            );
        }

        return $this->render('offer/list.html.twig', [
            'offers' => $offers,
        ]);
    }
}
