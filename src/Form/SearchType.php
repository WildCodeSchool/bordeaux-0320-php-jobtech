<?php


namespace App\Form;

use App\Entity\Contract;
use App\Entity\Job;
use App\Entity\Search\OfferSearch;
use App\Entity\WorkTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OfferSearch::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(): ?string
    {
        return '';
    }
}
