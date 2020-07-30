<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class UserNotActiveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, 'new')
            ->remove(Crud::PAGE_INDEX, 'edit')
            ->remove(Crud::PAGE_INDEX, 'delete');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('isActive');
    }

    public function configureFields(string $pageName): iterable
    {
        // FIELDS
        $id = IdField::new('id');
        $email = EmailField::new('email', 'Email');
        $active = BooleanField::new('isActive', 'Actif');
        $createdAt = DateTimeField::new('createdAt', 'Créer le');
        $updatedAt = DateTimeField::new('updatedAt', 'Dernière MAJ');

        $result = [];
        if (Crud::PAGE_INDEX === $pageName) {
            $result = [$id, $email, $active, $createdAt, $updatedAt];
        }

        return $result;
    }
}
