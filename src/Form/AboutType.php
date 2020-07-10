<?php


namespace App\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AboutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', CKEditorType::class, [
                'config' => [
                    'uicolor' => '#e2e2e2',
                    'toolbar' => 'standard',
                    'required' => true,
                ]
            ])
        ;
    }
}
