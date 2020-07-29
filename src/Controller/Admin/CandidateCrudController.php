<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidateCrudController extends AbstractCrudController
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

    public function configureFields(string $pageName): iterable
    {
        // Fields
        $id = IdField::new('candidate.id', 'Candidat');
        $email =  EmailField::new('email');
        // $gender = AssociationField::new('candidate.gender', 'Genre');
        $fullNameWithGender = TextField::new('candidate.fullNameWithGender', 'Nom');
        $surname = TextField::new('candidate.surname', 'Nom de famille');
        $firstName = TextField::new('candidate.firstName', 'Prénom');
        $phoneNumber = TelephoneField::new('candidate.phoneNumber', 'N° de téléphone');
        $formattedPhoneNumber = TelephoneField::new('candidate.formattedPhoneNumber', 'N° de téléphone');
        $otherNumber = TelephoneField::new('candidate.otherNumber', 'Autre N°');
        $formattedOtherNumber = TelephoneField::new('candidate.formattedOtherPhoneNumber', 'Autre N°');
        $postalCode = IntegerField::new('candidate.postalCode', 'Code Postal');
        $city = TextField::new('candidate.city', 'Ville');
        $country = TextField::new('candidate.country', 'Pays')
            ->setHelp('Utilise le code pays sous la norme ISO 3166-2, France -> FR');
        $isHandicapped = BooleanField::new('candidate.isHandicapped', 'Personne handicapé');
        $isContactableTel = BooleanField::new('candidate.isContactableTel', 'Contactable par téléphone');
        $isContactableEmail = BooleanField::new('candidate.isContactableEmail', 'Contactable par email');
        $haveVehicle = BooleanField::new('candidate.haveVehicle', 'Véhicule personnel');
        // $licenses = AssociationField::new('candidate.licenses');
        $createdAt = DateTimeField::new('createdAt', 'Créer le');
        $updatedAt = DateTimeField::new('updatedAt', 'Dernière MAJ');

        // Panels
        $contactPanel = FormField::addPanel('Contact');
        $addressPanel = FormField::addPanel('Adresse');
        $vehiclePanel = FormField::addPanel('Véhicule et permis');
        $otherInfoPanel = FormField::addPanel('Autres informations');

        $result = [];
        if (Crud::PAGE_INDEX === $pageName) {
            $result = [$id, $fullNameWithGender, $email, $formattedPhoneNumber, $city, $createdAt, $updatedAt];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            $result = [
                $id,
                $fullNameWithGender,
                $createdAt,
                $updatedAt,
                $contactPanel,
                $email,
                $isContactableEmail,
                $formattedPhoneNumber,
                $formattedOtherNumber,
                $isContactableTel,
                $addressPanel,
                $postalCode,
                $city,
                $country,
                $vehiclePanel,
                $haveVehicle,
                $otherInfoPanel,
                $isHandicapped,
            ];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            $result = [
                $surname,
                $firstName,
                $contactPanel,
                $email,
                $isContactableEmail,
                $phoneNumber,
                $otherNumber,
                $isContactableTel,
                $addressPanel,
                $postalCode,
                $city,
                $country,
                $haveVehicle,
                $vehiclePanel,
                $isHandicapped
            ];
        }

        return $result;
    }
}
