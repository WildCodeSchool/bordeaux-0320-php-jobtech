<?php
namespace App\Form;

use App\Entity\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email :'
            ])
            ->add('poste', TextType::class, [
                'label' => 'Poste :'
            ])
            ->add('phoneNumber', IntegerType::class, [
                'label' => 'Numéro de téléphone :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
