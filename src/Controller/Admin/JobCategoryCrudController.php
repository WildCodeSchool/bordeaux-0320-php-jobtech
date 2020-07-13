<?php

namespace App\Controller\Admin;

use App\Entity\JobCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobCategory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title', 'Intitulé');
        $icon = TextField::new('icon', 'Icône')
            ->setHelp('Les icônes sont à prendre sur Font Awesome | https://fontawesome.com/icons?d=gallery');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $icon];
        }

        if (Crud::PAGE_NEW === $pageName) {
            return [$title, $icon];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            return [$title, $icon];
        }
    }
}
