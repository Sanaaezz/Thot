<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Genre;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Constraints\Required;

class ArticleType extends AbstractType
{
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_article')
            ->add('texte_article', TextareaType::class)
            ->add('date_article', null, [
                'widget' => 'single_text',
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'id',
            ])
            ->add('classer', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom_categorie',
                'multiple' => true,
            ])
            ->add('style', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom_genre',
            ]);
            
            if ($this->authorizationChecker->isGranted('ROLE_ADMIN')){
                $builder->add('statut_article', CheckboxType::class, [
                'label' => 'statut_article',
                'required' => false,
                ]);
            };
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
