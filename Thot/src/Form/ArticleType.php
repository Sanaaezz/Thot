<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Genre;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_article')
            ->add('texte_article')
            ->add('date_article', null, [
                'widget' => 'single_text',
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'id',
            ])
            ->add('classer', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('style', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
