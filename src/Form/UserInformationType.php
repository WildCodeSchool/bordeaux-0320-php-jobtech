<?php

namespace App\Form;

use App\Entity\UserInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                ->add('lastname')
                ->add('firstname')
                ->add('birthday', DateType::class, [
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'js-datepicker']
                ])
                ->add('phoneNumber')
                ->add('homeNumber')
                ->add('postalCode')
                ->add('city')
                ->add('country')
                ->add('isHandicapped')
                ->add('isContactableTel')
                ->add('isContactableEmail');
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
