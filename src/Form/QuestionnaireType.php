<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $num = 0;
        foreach ($options['questions'] as $question) {
            $builder->add('question' . $num, RangeType::class, [
                'label' => $question->getQuestion(),
                'label_attr' => ['class' => 'text-secondary font-weight-bolder'],
                'attr' => ['min' => 0, 'max' => 4],
                'constraints' => new Range(['min' => '0', 'max' => 4])
            ])
                ->add('ability' . $num, HiddenType::class, [
                    'attr' => ['value' => $question->getAbility()->getId()]
                ]);
            $num++;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'questions' => [],
        ]);
    }
}
