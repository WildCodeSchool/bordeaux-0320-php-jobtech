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
            ->add('html', CKEditorType::class, [
                'config' => [
                    'toolbar' => 'standard',
                ]
            ])
        ;
    }
}
