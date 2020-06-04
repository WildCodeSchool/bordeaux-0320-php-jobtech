<?php


namespace App\Controller;

use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news_list")
     * @return Response A response instance
     */
    public function list(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findBy([], ['createdOn' => 'DESC'], 5, 0);

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
