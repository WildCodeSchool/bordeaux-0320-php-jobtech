<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $num = 0;
        foreach ($options['questions'] as $question) {
            $builder->add('question' . $num, IntegerType::class, [
                'label' => $question->getQuestion(),
                'attr' => ['min' => 0, 'max' => 5],
                'constraints' => new Range(['min' => '0', 'max' => 5])
            ])
                ->add('ability' . $num, HiddenType::class, [
                    'attr' => ['value' => $question->getAbility()->getId()]
                ]);
            $num++;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'questions' => [],
        ]);
    }
}
