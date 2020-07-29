<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/message", name="message_")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param MessageRepository $messageRepository
     * @return Response
     */
    public function inbox(MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findBy([], ['postedAt' => 'DESC']);

        return $this->render('messages/user_inbox.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @Route("/nouveau", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function newMessage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newMessage = new Message();
        $form = $this->createForm(MessageType::class, $newMessage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newMessage->setContact($this->getUser());
            $entityManager->persist($newMessage);
            $entityManager->flush();
            return $this->redirectToRoute('message_index');
        }
        return $this->render('messages/new_message.html.twig', [
            'addMessage' => $form->createView(),
        ]);
    }
}
