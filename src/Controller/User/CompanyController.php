<?php
namespace App\Controller\User;

use App\Entity\Contact;
use App\Form\User\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController
 * @package App\Controller\User
 * @Route("/entreprise", name="entreprise_")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/{id}/contact/edit", name="contact_edit")
     * @param Contact $contact
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editContact(Contact $contact, Request $request)
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('profile');
        }
        return $this->render('user/company/edit_company_contact.html.twig', [
            'contact' =>$form->createView()
        ]);
    }
}
