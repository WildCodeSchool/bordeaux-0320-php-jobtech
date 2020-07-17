<?php

namespace App\Controller\Admin;

use App\Entity\Ability;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AbilityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ability::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id');
        $isProfessional = BooleanField::new('isProfessional', 'Personnel | Professionnel');
        $title = TextField::new('title', 'Compétence');
        $nbQuestion = IntegerField::new('nbQuestion', 'Questions affichées');
        $availableQuestion = AssociationField::new('questions', 'Questions disponibles');
        $questions = ArrayField::new('questions', 'Questions');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $isProfessional, $title, $nbQuestion, $availableQuestion];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            return [
                $id,
                $isProfessional->setLabel('Professionnel ?'),
                $title,
                $nbQuestion,
                FormField::addPanel('Questions'),
                $questions->setLabel('')
            ];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            return [
                $isProfessional
                    ->setLabel('Compétence professionnelle ?')
                    ->setHelp('Laisser décocher pour une compétence personnelle'),
                $title->setLabel('Intitulé de la compétence'),
                $nbQuestion
                    ->setLabel('Nombre de questions')
                    ->setHelp('Nombre de questions utilisées quand un questionnaire est généré.'),
            ];
        }

        if (Crud::PAGE_NEW === $pageName) {
            return [
                $isProfessional
                    ->setLabel('Compétence professionnelle ?')
                    ->setHelp('Laisser décocher pour une compétence personnelle'),
                $title,
                $nbQuestion
            ];
        }
    }
}
