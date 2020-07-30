<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function index(AdminContext $context)
    {
        $imageRepository = $this->getDoctrine()->getRepository(Image::class);

        return $this->render('admin/images.html.twig', [

        ]);
    }
}
