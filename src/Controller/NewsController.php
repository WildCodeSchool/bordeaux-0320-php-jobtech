<?php


namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actualites", name="news_")
 */
class NewsController extends AbstractController
{
    public const LIMIT_NEWS_PER_PAGE = 5;

    /**
     * @Route("/{id}", name="show")
     * @param News $news
     * @return Response
     */
    public function show(News $news): Response
    {
        return $this->render('news/show.html.twig', ['actuality' => $news]);
    }

    /**
     * @Route("/", name="list")
     * @param NewsRepository $newsRepository
     * @param Paginator $paginator
     * @return Response
     */
    public function list(NewsRepository $newsRepository, Paginator $paginator): Response
    {
        $actualities = $newsRepository->findBy([], ['postedAt' => 'DESC']);
        $actualities = $paginator->paging($actualities, self::LIMIT_NEWS_PER_PAGE);

        if (!$actualities) {
            throw $this->createNotFoundException(
                'No news found in news table.'
            );
        }
        return $this->render('news/list.html.twig', [
            'actualities' => $actualities,
        ]);
    }
}
