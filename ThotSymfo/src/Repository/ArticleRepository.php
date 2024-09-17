<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

       /**
        * @return Article[] Returns an array of Article objects
        */
       public function findByFiltres($titre,$categorie,$genre): array
       {
           $rech= $this->createQueryBuilder('a')

               ->andWhere('a.titre_article LIKE :titre')
               ->setParameter('titre', '%'.$titre.'%' )
               ->orderBy('a.titre_article', 'ASC');

            if ($categorie !== 'ttCat'){
                $rech->join('a.classer', 'c')
                 ->andWhere('c.id = :categorie')
                 ->setParameter('categorie', $categorie); }

                if ($genre !== 'ttGenre'){
                    $rech->join('a.style', 'genre')
                    ->andWhere('genre.id = :genre')
                    ->setParameter('genre', $genre);

                }
                return $rech
               ->setMaxResults(10)
               ->getQuery()
               ->getResult()
           ;
       }


    // public function findByFiltres($titre = null, $categorie = null, $genre = null): array
    // {
        
    //     $qb = $this->createQueryBuilder('a');

    //     // Filtre par titre (si fourni)
    //     if ($titre) {
    //         $qb->andWhere('a.titre_article LIKE :titre')
    //         ->setParameter('titre', '%' . $titre . '%');
    //     }

    //     // Filtre par catégorie (si fourni)
    //     if ($categorie) {
    //         $qb->andWhere('a.categorie = :categorie')
    //         ->setParameter('categorie', $categorie);
    //     }

    //     // Filtre par genre (si fourni)
    //     if ($genre) {
    //         $qb->andWhere('a.genre = :genre')
    //         ->setParameter('genre', $genre);
    //     }

    //     // Ordre des résultats
    //     $qb->orderBy('a.titre_article', 'ASC')
    //         ->setMaxResults(10);

    //     // Exécution de la requête et retour des résultats
    //     return $qb->getQuery()->getResult();
    // }






    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
