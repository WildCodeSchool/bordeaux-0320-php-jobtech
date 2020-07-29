<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/messagerie", name="message_")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="inbox")
     * @param MessageRepository $messageRepository
     * @return Response
     */
    public function inbox(MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findBy(['contact' => $this->getUser()], ['postedAt' => 'DESC']);

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
        $admin = $this->isGranted('ROLE_ADMIN');
        $form = $this->createForm(MessageType::class, $newMessage, ['admin' => $admin]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$admin) {
                $newMessage->setContact($this->getUser());
            }
            if ($admin) {
                $newMessage->setIsToContact(true);
            }
            $entityManager->persist($newMessage);
            $entityManager->flush();
            return $this->redirectToRoute($admin ? 'message_admin_inbox' : 'message_inbox');
        }
        return $this->render('messages/new_message.html.twig', [
            'addMessage' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/", name="admin_inbox")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function adminInbox(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAllContact();

        return $this->render('messages/admin_inbox.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/admin/{id}", name="admin_message")
     * @param MessageRepository $messageRepository
     * @param UserRepository $userRepository
     * @param User $user
     * @return Response
     */
    public function adminMessage(
        MessageRepository $messageRepository,
        UserRepository $userRepository,
        User $user
    ): Response {
        $users = $userRepository->findAllContact();
        $messages = $messageRepository->findBy(['contact' => $user]);

        return $this->render('messages/admin_inbox.html.twig', [
            'users' => $users,
            'messages' => $messages,
        ]);
    }
}
