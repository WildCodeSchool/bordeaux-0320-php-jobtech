<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionnaireController extends AbstractController
{
    /**
     * @Route("/questionnaire", name="questionnaire")
     */
    public function index()
    {
        return $this->render('questionnaire/index.html.twig', [
            'controller_name' => 'QuestionnaireController',
        ]);
    }
}
