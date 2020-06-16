<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['action'] === 'create_company') {
            $builder
                ->add('name', TextType::class, [
                    'label' => 'Nom de l\'entreprise :'
                ])
                //   ->add('siret')
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
                    'label' => 'Adresse'
                ])
                ->add('contacts', ContactType::class, [
                    'action' => $options['action']
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
