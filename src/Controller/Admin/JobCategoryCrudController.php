<?php

namespace App\Controller\Admin;

use App\Entity\JobCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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

        $result = [];
        if (Crud::PAGE_INDEX === $pageName) {
            $result = [$id, $title, $icon];
        }

        if (Crud::PAGE_NEW === $pageName) {
            $result = [$title, $icon];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            $result = [$title, $icon];
        }

        return $result;
    }
}
