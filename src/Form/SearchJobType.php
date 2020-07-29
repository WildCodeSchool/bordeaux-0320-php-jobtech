<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\JobCategory;
use App\Entity\Search;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchJobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contracts')
            ->add('jobCategory', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => JobCategory::class,
                'choice_label' => 'title',
                'placeholder' => 'Secteur'
            ]);
        $builder
            ->get('jobCategory')->addEventListener(
                FormEvents::POST_SUBMIT,
                static function (FormEvent $event) {
                    $form = $event->getForm();
                    $form->getParent()->add('job', EntityType::class, [
                        'label' => false,
                        'required' => false,
                        'class' => Job::class,
                        'placeholder' => 'Métier',
                        'choices' => $form->getData()->getJobs()
                    ]);
                }
            );
        $builder
            ->addEventListener(
                FormEvents::POST_SET_DATA,
                static function (FormEvent $event) {
                    $form = $event->getForm();

                    $form->add('job', null, [
                        'label' => false,
                        'required' => false,
                        'class' => Job::class,
                        'placeholder' => 'Métier',
                        'choices' => []
                    ]);
                }
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
        ]);
    }
}
