<?php

namespace App\Form;

use App\Entity\Contract;
use App\Entity\WorkTime;
use App\Entity\Job;
use App\Entity\JobCategory;
use App\Entity\Offer;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Nom de l\'annonce'
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Description de l\'offre'
            ])
            ->add('availablePlace', IntegerType::class, [
                'label' => 'Nombre de postes'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('postalCode', IntegerType::class, [
                'label' => 'Code postal'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays'
            ])
            ->add('contracts', EntityType::class, [
                'class' => Contract::class,
                'label' => 'Contrat',
                'choice_label' => 'title',
                'multiple' => true,
            ])
            ->add('workTime', EntityType::class, [
                'class'=>WorkTime::class,
                'choice_label'=>'title',
                'label' => 'Temps de travail'
            ])
            ->add('jobCategory', EntityType::class, [
                'class'=>JobCategory::class,
                'choice_label'=>'title',
                'label'=> 'Catégorie'
            ])
            ->add('job', EntityType::class, [
                'class'=>Job::class,
                'choice_label'=>'title',
                'label' => 'Métier',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
