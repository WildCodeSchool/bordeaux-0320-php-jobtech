<?php

namespace App\Form;

use App\Entity\Company;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['action'] === 'create_company') {
            $builder
                ->add('name', CKEditorType::class)
                ->add('siret')
                ->add('postalCode')
                ->add('city')
                ->add('country')
                ->add('address');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
