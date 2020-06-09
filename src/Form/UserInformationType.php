<?php

namespace App\Form;

use App\Entity\UserInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('birthday')
            ->add('phoneNumber')
            ->add('homeNumber')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('isHandicapped')
            ->add('isContactableTel')
            ->add('isContactableEmail')
            ->add('haveVehicle')
            ->add('curriculumVitae')
            ->add('license')
            ->add('mobility')
            ->add('skill')
            ->add('currentSituation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserInformation::class,
        ]);
    }
}
