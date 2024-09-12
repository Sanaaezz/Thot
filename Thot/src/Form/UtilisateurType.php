<?php

namespace App\Form;

use App\Entity\Avatar;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('rgpd_utilisateur', null, [
                'widget' => 'single_text',
            ])
            ->add('nom_utilisateur')
            ->add('nomdeplume_utilisateur')
            ->add('presentation_utilisateur')
            ->add('avoir', EntityType::class, [
                'class' => Avatar::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
