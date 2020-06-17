<?php

namespace App\Form;

use App\Entity\UserInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

            /*$builder
                ->add('haveVehicle')
                ->add('curriculumVitae')
                ->add('license')
                ->add('mobility')
                ->add('skill')
                ->add('currentSituation');*/

        if ($options['action'] === 'create_candidat') {
            $builder
                ->add('lastname', TextType::class, [
                    'label' => 'Nom :'])

                ->add('firstname', TextType::class, [
                    'label' => 'Prénom :'
                ])
                ->add('birthday', DateType::class, [
                    'label' => 'date de naissance :',
                    'widget' => 'single_text'
                ])
                ->add('phoneNumber', IntegerType::class, [
                    'label' => 'Numéro portable :'
                ])
                ->add('homeNumber', IntegerType::class, [
                    'label' => 'Autre numéro :'
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
                    'label' => 'Je souhaite faire part d\'une situation d\'handicap.'
                ])
                ->add('isContactableTel', CheckboxType::class, [
                    'label' => 'par téléphone.'
                ])
                ->add('isContactableEmail', CheckboxType::class, [
                    'label' => 'par Email.'
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserInformation::class,
            'action' => '',
        ]);
    }
}
