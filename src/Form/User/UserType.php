<?php

namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType
{
    public const CREATE_CANDIDATE = 'create_candidate';
    public const CREATE_COMPANY = 'create_company';
    public const EDIT_CONNECTION_INFORMATION = 'connexion';
    public const EDIT_CANDIDATE_PERSONAL_INFORMATION = 'personal_information';
    public const EDIT_COMPANY_INFORMATION = 'company_information';


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['action'] === self::CREATE_CANDIDATE) {
            $this->connectionInformation($builder)
                ->agreeTerms($builder)
                ->candidate($builder, $options);
        }

        if ($options['action'] === self::CREATE_COMPANY) {
            $this->connectionInformation($builder)
                ->agreeTerms($builder)
                ->company($builder, $options);
        }

        if ($options['action'] === self::EDIT_CONNECTION_INFORMATION) {
            $this->connectionInformation($builder);
        }

        if ($options['action'] === self::EDIT_COMPANY_INFORMATION) {
            $this->company($builder, $options);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'action' => '',
        ]);
    }

    private function connectionInformation(FormBuilderInterface $builder): self
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email :'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmer :']
            ]);

        return $this;
    }

    private function agreeTerms(FormBuilderInterface $builder): self
    {
        $builder->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'attr' => ['class' => 'agree'],
            'label' => 'En cochant cette case, je reconnais avoir pris 
                connaissance et accepte la politique de confidentialité relative aux données des candidats.',
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter les conditions',
                ]),
            ],
        ]);

        return $this;
    }

    private function candidate(FormBuilderInterface $builder, array $options): self
    {
        $builder->add('candidate', CandidateType::class, [
            'action' => $options['action'],
            'label' => false,
        ]);

        return $this;
    }

    private function company(FormBuilderInterface $builder, array $options): self
    {
        $builder->add('company', CompanyType::class, [
            'action' => $options['action'],
            'label' => false,
        ]);

        return $this;
    }
}
