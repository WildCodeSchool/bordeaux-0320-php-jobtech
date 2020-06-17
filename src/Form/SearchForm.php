<?php


namespace App\Form;

use App\Entity\Contract;
use App\Entity\WorkTime;
use App\Entity\Job;
use App\Entity\Search\OfferSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'placeholder' => 'Métier'
            ])
            ->add('contract', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Contract::class,
                'choice_label' => 'title',
                'placeholder' => 'Type de contrat'
            ])
            ->add('workTime', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => WorkTime::class,
                'choice_label' => 'title',
                'placeholder' => 'Temps de travail'
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
