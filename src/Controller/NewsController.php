<?php


namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news", name="news_")
 */
class NewsController extends AbstractController
{
    const MAX_NEWS_PER_PAGE = 5;

    /**
     * @Route("/", name="list")
     * @param NewsRepository $newsRepository
     * @return Response
     */
    public function list(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findBy([], ['createdOn' => 'DESC'], self::MAX_NEWS_PER_PAGE);

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found in news table.'
            );
        }
        return $this->render(
            'job_tech/news/list.html.twig',
            ['news' => $news]
        );
    }
}
