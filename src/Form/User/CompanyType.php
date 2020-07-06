<?php

namespace App\Form\User;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'entreprise :'
            ])
            ->add('postalCode', IntegerType::class, [
                'label' => 'Code Postal :'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :'
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays :'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse :'
            ])
            ->add('contacts', CollectionType::class, [
                'entry_type' => ContactType::class,
                'entry_options' => ['label' => false],
            ]);
            //->add('siret')
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
