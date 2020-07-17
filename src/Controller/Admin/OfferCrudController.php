<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        // FIELDS
        $id = IdField::new('id', 'ID');
        $title = TextField::new('title', 'Titre');
        $description = TextEditorField::new('description', 'Description');
        $availablePlace = IntegerField::new('availablePlace', 'Places disponibles');
        $address = TextField::new('address', 'Adresse');
        $postalCode = IntegerField::new('postalCode', 'Code postal');
        $city = TextField::new('city', 'Ville');
        $country = TextField::new('country', 'Pays');
        $postedAt = DateTimeField::new('postedAt', 'Poster le');
        $updatedAt = DateTimeField::new('updatedAt', 'MAJ le');
        $company = AssociationField::new('company', 'Entreprise');
        $job = AssociationField::new('job', 'Métier');
        $jobCategory = AssociationField::new('jobCategory', 'Secteur d\'activité');
        $workTime = AssociationField::new('workTime', 'Temps de travail');
        $contracts = AssociationField::new('contracts', 'Contrats');
        $contractsShow = ArrayField::new('contracts', 'Contrats');

        // PANELS
        $addressPanel = FormField::addPanel('Adresse');
        $jobPanel = FormField::addPanel('Métier');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $company, $availablePlace, $city, $postedAt, $updatedAt];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            return [
                $id,
                $company,
                $title,
                $description,
                $contractsShow,
                $jobPanel,
                $job,
                $jobCategory,
                $availablePlace,
                $workTime,
                $addressPanel,
                $address,
                $postalCode,
                $city,
                $country
            ];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            return [
                $title, $description, $contracts, $jobPanel, $job, $jobCategory, $availablePlace, $workTime,
                $addressPanel, $address, $postalCode, $city, $country
            ];
        }

        if (Crud::PAGE_NEW === $pageName) {
            return [
                $title, $description, $company, $contracts, $jobPanel, $job, $jobCategory, $availablePlace, $workTime,
                $addressPanel, $address, $postalCode, $city, $country
            ];
        }
    }
}
