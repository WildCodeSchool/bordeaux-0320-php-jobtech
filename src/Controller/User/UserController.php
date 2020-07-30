<?php

namespace App\Controller\User;

use App\Entity\Company;
use App\Entity\Contact;
use App\Entity\CurriculumVitae;
use App\Entity\Image;
use App\Entity\User;
use App\Form\User\CandidateType;
use App\Form\User\CurriculumVitaeType;
use App\Form\User\UserType;
use App\Repository\ImageRepository;
use App\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profile")
     * @param Request $request
     * @return Response
     */
    public function profile(Request $request): Response
    {
        $user = $this->getUser();
        if ($this->isGranted('ROLE_COMPANY')) {
            $contact = $user->getCompany()->getContact();
        }
        if ($this->isGranted('ROLE_CANDIDATE')) {
            $curriculumVitae = $user->getCandidate()->getCurriculumVitae();
            $newCV = new CurriculumVitae();
            $newCV->setCandidate($this->getUser()->getCandidate());
            $form = $this->createForm(CurriculumVitaeType::class, $newCV);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
            }
        }
        return $this->render('user/profile.html.twig', [
            'contact' => $contact ?? null,
            'user' => $user,
            'form' => isset($form) ? $form->createView() : null,
            'cv' => $curriculumVitae ?? null,
        ]);
    }

    /**
     * @Route("/edit/{action}", name="edit_user")
     * @param string $action
     * @param Request $request
     * @return Response
     */
    public function edit(string $action, Request $request): Response
    {
        if ($action === UserType::EDIT_CANDIDATE_PERSONAL_INFORMATION) {
            $form = $this->createForm(CandidateType::class, $this->getUser()->getCandidate(), ['action' => $action]);
        } else {
            $form = $this->createForm(UserType::class, $this->getUser(), ['action' => $action]);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'action' => $action
        ]);
    }

    /**
     * @Route("/inscription/{action<^create_[a-z]*$>}", name="register", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param UserAuthenticator $authenticator
     * @param ImageRepository $imageRepository
     * @param string $action
     * Action is a parameter to select the type of user to be created.
     * @return Response
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        UserAuthenticator $authenticator,
        ImageRepository $imageRepository,
        string $action
    ): ?Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }

        $user = new User();
        $image = Image::REGISTER_CANDIDATE['identifier'];
        if ($action === UserType::CREATE_COMPANY) {
            $image = Image::REGISTER_COMPANY['identifier'];
        }

        $form = $this->createForm(UserType::class, $user, ['action' => $action]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            if ($action === UserType::CREATE_COMPANY) {
                $user->setRoles(['ROLE_COMPANY']);
            }
            if ($action === UserType::CREATE_CANDIDATE) {
                $user->setRoles(['ROLE_CANDIDATE']);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('user/register.html.twig', [
            'register' => $form->createView(),
            'action' => $action,
            'image' => $imageRepository->findOneBy(['identifier' => $image])
        ]);
    }

    /**
     * @Route("/connexion", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @param ImageRepository $imageRepository
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils, ImageRepository $imageRepository): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'image' => $imageRepository->findOneBy(['identifier' => Image::LOGIN['identifier']])
        ]);
    }
}
