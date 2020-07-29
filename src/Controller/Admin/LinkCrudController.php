<?php

namespace App\Controller\Admin;

use App\Entity\Link;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LinkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Link::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, 'new')
            ->remove(Crud::PAGE_INDEX, 'delete');
    }

    public function configureFields(string $pageName): iterable
    {
        // FIELDS
        $identifier = TextField::new('identifier', 'Lien');
        $content = TextareaField::new('content', 'Contenu');

        $result = [];
        if (Crud::PAGE_INDEX === $pageName) {
            $result = [$identifier, $content];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            $result = [$content];
        }

        return $result;
    }
}
