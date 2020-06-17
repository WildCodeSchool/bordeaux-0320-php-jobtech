<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class RegisterType extends AbstractType
{
    const ACTION_CREATE_CANDIDAT = 'create_candidat';
    const ACTION_CREATE_COMPANY = 'create_company';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email :'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'J\'accepte les conditions',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmer :']
            ]);

        if ($options['action'] === self::ACTION_CREATE_CANDIDAT) {
            $builder
                ->add('userInformation', UserInformationType::class, ['action' => $options['action']]);
        }

        if ($options['action'] === self::ACTION_CREATE_COMPANY) {
            $builder
                ->add('company', CompanyType::class, ['action' => $options['action']]);
        }
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'action' => '',
        ]);
    }
}
