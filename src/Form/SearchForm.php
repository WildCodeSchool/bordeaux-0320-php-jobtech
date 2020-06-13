<?php


namespace App\Form;

use App\Entity\Contract;
use App\Entity\DurationWorkTime;
use App\Entity\Job;
use App\Entity\Offer;
use App\Service\OfferSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('query', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])
            ->add('job', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Job::class,
                'choice_label' => 'title',
                'placeholder' => 'Choisissez un métier dans la liste déroulante'
            ])
            ->add('contract', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Contract::class,
                'choice_label' => 'title',
                'placeholder' => 'Choisissez un type de contrat dans la liste déroulante'
            ])
            ->add('duration', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => DurationWorkTime::class,
                'choice_label' => 'title',
                'placeholder' => 'Choisissez un temps de travail dans la liste déroulante'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OfferSearch::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
