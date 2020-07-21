<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, 'new');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Entreprises')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Entreprises')
            ->setPageTitle(Crud::PAGE_EDIT, 'Entreprises');
    }

    public function configureFields(string $pageName): iterable
    {
        // FIELDS
        $id = IdField::new('id');
        $name = TextField::new('company.name', 'Entreprise');
        $siret = TextField::new('company.siret', 'Siret');
        $address = TextField::new('company.address', 'Rue');
        $postalCode = IntegerField::new('company.postalCode', 'Code Postal');
        $city = TextField::new('company.city', 'Ville');
        $country = TextField::new('company.country', 'Pays')
            ->setHelp('Utilise le code pays sous la norme ISO 3166-2, France -> FR');
        $createdAt = DateTimeField::new('createdAt', 'Créer le');
        $updatedAt = DateTimeField::new('updatedAt', 'Dernière MAJ');

        // PANELS
        $addressPanel = FormField::addPanel('Adresse');

        $result = [];
        if (Crud::PAGE_INDEX === $pageName) {
            $result = [$id, $name, $city, $createdAt, $updatedAt];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            $result = [
                $id, $name, $siret, $createdAt, $updatedAt, $addressPanel, $address, $postalCode, $city, $country
            ];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            $result = [$name, $siret, $addressPanel, $address, $postalCode, $city, $country];
        }

        return $result;
    }
}
