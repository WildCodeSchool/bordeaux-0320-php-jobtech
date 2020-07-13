<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title', 'Intitulé');
        $jobCategory = AssociationField::new('jobCategory', 'Catégorie');
        $jobCategoryShow = ArrayField::new('jobCategory', 'Catégorie');
        $offers = AssociationField::new('offers', 'Offres disponibles');
        $offersShow = ArrayField::new('offers', 'Offres disponibles');
        $searches = AssociationField::new('searches', 'Recherches');
        $searchesShow = ArrayField::new('searches', 'Recherches')
            ->setHelp('Personne cherchant un contrat dans ce travail.');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $jobCategory, $offers, $searches];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $jobCategoryShow, $offersShow, $searchesShow];
        }

        if (Crud::PAGE_NEW === $pageName) {
            return [$title, $jobCategory];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            return [$title, $jobCategory];
        }
    }
}
