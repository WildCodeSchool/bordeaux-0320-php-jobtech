<?php

namespace App\Form\User;

use App\Entity\Candidate;
use App\Entity\Gender;
use App\Entity\License;
use PHPStan\Type\Traits\FalseyBooleanTypeTrait;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['action'] === UserType::CREATE_CANDIDATE) {
            $this->personalInformation($builder, $options);
        }

        if ($options['action'] === UserType::EDIT_CANDIDATE_PERSONAL_INFORMATION) {
            $this->personalInformation($builder, $options)
                ->vehicleAndLicense($builder);
        }

        /**
         * $builder
         *  ->add('haveVehicle')
         *  ->add('curriculumVitae')
         *  ->add('license')
         *  ->add('mobility')
         *  ->add('skill')
         *  ->add('currentSituation');
         */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
            'action' => '',
        ]);
    }

    private function personalInformation(FormBuilderInterface $builder, array $options): self
    {
        $builder
            ->add('gender', EntityType::class, [
                'label' => false,
                'class' => Gender::class,
                'attr' => ['class' => 'mt-4'],
                'choice_label' => 'acronym',
                'expanded' => true,
                'disabled' => $options['action'] !== UserType::CREATE_CANDIDATE,
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :'
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'Date de naissance :'
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Numéro portable :',
            ])
            ->add('otherNumber', TelType::class, [
                'label' => 'Autre numéro :',
                'required' => false,
            ])
            ->add('postalCode', IntegerType::class, [
                'label' => 'Code postale :'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :'
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays :'
            ])
            ->add('isHandicapped', CheckboxType::class, [
                'label' => 'Je souhaite faire part d\'une situation d\'handicap.',
                'required' => false,
            ])
            ->add('isContactableTel', CheckboxType::class, [
                'label' => 'par téléphone.',
                'required' => false,
            ])
            ->add('isContactableEmail', CheckboxType::class, [
                'label' => 'par Email.',
                'required' => false,
                'attr' => ['checked' => true]
            ]);

        return $this;
    }

    private function vehicleAndLicense(FormBuilderInterface $builder): self
    {
        $builder
            ->add('haveVehicle', CheckboxType::class)
            ->add('licenses', EntityType::class, [
                'label' => 'Permis :',
                'class' => License::class,
                'choice_label' => 'title',
                'placeholder' => 'Choisir un permis.',
                'required' => false,
                'multiple' => true
            ]);

        return $this;
    }
}
