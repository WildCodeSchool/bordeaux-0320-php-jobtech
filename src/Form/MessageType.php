<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Message;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                'label' => 'Objet :'
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Message :'
            ]);
        if ($options['admin'] ===  true) {
            $builder
                ->add('contact', EntityType::class, [
                    'label' => 'Destinataire : ',
                    'class' => User::class,
                    'choice_label' => static function (User $user) {
                        if ($user->getCandidate() !== null) {
                            return $user->getCandidate()->getFullName();
                        }

                        return $user->getCompany()->getName();
                    }
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
            'admin' => false,
        ]);
    }
}
