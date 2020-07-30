<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class ImageCrudController extends AbstractCrudController
{
    private RequestStack $request;

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, 'new')
            ->remove(Crud::PAGE_INDEX, 'delete');
    }

    public function edit(AdminContext $context)
    {
        $imageRepository = $this->getDoctrine()->getRepository(Image::class);
        $image = $imageRepository->findOneBy(['identifier' => $context->getEntity()->getInstance()->getIdentifier()]);

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($this->request->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
        }

        return $this->render('admin/images_edit.html.twig', [
            'image' => $image,
            'form' => $form->createView()
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        // FIELDS
        $title = TextField::new('title', 'Image');

        $result = [];
        if (Crud::PAGE_INDEX === $pageName) {
            $result = [$title];
        }

        return $result;
    }
}
