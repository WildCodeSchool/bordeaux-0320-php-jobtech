<?php

namespace App\Form\User;

use App\Entity\Contact;
use App\Entity\Gender;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', EntityType::class, [
                'label' => false,
                'attr' => ['class' => 'mt-4'],
                'class' => Gender::class,
                'choice_label' => 'acronym',
                'expanded' => true
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email :'
            ])
            ->add('job', TextType::class, [
                'label' => 'Poste :'
            ])
            ->add('phoneNumber', IntegerType::class, [
                'label' => 'Numéro de téléphone :'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
