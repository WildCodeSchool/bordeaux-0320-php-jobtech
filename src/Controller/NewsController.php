<?php


namespace App\Controller;

use App\Repository\NewsRepository;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news", name="news_")
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @param NewsRepository $newsRepository
     * @param Paginator $paginator
     * @return Response
     */
    public function list(NewsRepository $newsRepository, Paginator $paginator): Response
    {
        $news = $newsRepository->findBy([], ['createdAt' => 'DESC']);
        $appointments = $paginator->paging($news, 5);

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found in news table.'
            );
        }
        return $this->render('job_tech/news/list.html.twig', [
             'appointments' => $appointments,
        ]);
    }
}
