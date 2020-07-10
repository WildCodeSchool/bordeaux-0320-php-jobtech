<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Job')
            ->setEntityLabelInPlural('Job')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des métiers')
            ->setSearchFields(['id', 'title', 'identifier']);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $identifier = TextField::new('identifier');
        $jobCategory = AssociationField::new('jobCategory');
        $offers = AssociationField::new('offers');
        $searches = AssociationField::new('searches');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $identifier, $jobCategory, $offers, $searches];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $identifier, $jobCategory, $offers, $searches];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$title, $identifier, $jobCategory, $offers, $searches];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$title, $identifier, $jobCategory, $offers, $searches];
        }
    }
}
