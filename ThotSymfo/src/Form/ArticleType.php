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
            ->add('titre_article',null,[
                 'label'=>'Titre : ',
                 'attr'=>[
                    'class'=>'my-2'
                    ]
            ])

            ->add('texte_article', TextareaType::class,[
                'label' =>'A votre clavier',
                'attr' => [
                    'class' => 'my-2'
                ]
            ])

            ->add('date_article', null, [
                'widget' => 'single_text',
                'label' => 'Choisissez une date : ',
            'attr' => [
                'class' => 'my-2'
            ]
            ]);

            if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $builder
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'id',
            ]);}


        $builder
            ->add('classer', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom_categorie',  
                'multiple' => true,                 
                'expanded' => true,                
                'label' => 'Choisissez les catégories : ',
                'attr' => [
                    'class' => 'my-4'
                ]
            ])

            ->add('style', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom_genre',
                'label' => 'Genre : ',
            'attr' => [
                'class' => 'my-4'
            ]
    
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
