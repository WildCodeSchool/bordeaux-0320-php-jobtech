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
        $title = TextField::new('title');
        $description = TextEditorField::new('description');
        $availablePlace = IntegerField::new('availablePlace');
        $address = TextField::new('address');
        $postalCode = IntegerField::new('postalCode');
        $city = TextField::new('city');
        $country = TextField::new('country');
        $postedAt = DateTimeField::new('postedAt');
        $updatedAt = DateTimeField::new('updatedAt');
        $company = AssociationField::new('company');
        $job = AssociationField::new('job');
        $jobCategory = AssociationField::new('jobCategory');
        $workTime = AssociationField::new('workTime');
        $contracts = AssociationField::new('contracts');
        $contractsShow = ArrayField::new('contracts');

        // PANELS
        $addressPanel = FormField::addPanel('Adresse');
        $jobPanel = FormField::addPanel('Métier');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $company, $availablePlace, $city, $postedAt, $updatedAt];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            return [
                $id,
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
