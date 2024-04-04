<?php

namespace App\Repository;

use App\Entity\Plat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plat>
 *
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plat::class);
    }

    public function BestSeller()
    {
        return $this->createQueryBuilder('plat')
            ->select('plat, SUM(detail.quantite) AS totalQuantite') // Sélectionnez le total de la quantité de détail
            ->leftJoin('plat.details', 'detail') // Utilisez LEFT JOIN pour inclure les plats même s'ils n'ont pas de détails de vente
            ->groupBy('plat') // Regrouper par plat
            ->orderBy('totalQuantite', 'DESC') // Trier par quantité totale DESC pour obtenir les meilleurs vendeurs en premier
            ->having('totalQuantite > 0') // Exclure les résultats avec totalQuantite de 0
            ->setMaxResults(3) // Limiter les résultats à 10
            ->getQuery()
            ->getResult();
    }
    public function BestSellerSm()
    {
        return $this->createQueryBuilder('plat')
            ->select('plat, SUM(detail.quantite) AS totalQuantite') // Sélectionnez le total de la quantité de détail
            ->leftJoin('plat.details', 'detail') // Utilisez LEFT JOIN pour inclure les plats même s'ils n'ont pas de détails de vente
            ->groupBy('plat') // Regrouper par plat
            ->orderBy('totalQuantite', 'DESC') // Trier par quantité totale DESC pour obtenir les meilleurs vendeurs en premier
            ->having('totalQuantite > 0') // Exclure les résultats avec totalQuantite de 0
            ->getQuery()
            ->getResult();
    }

    

       public function search($value): array
       {
           return $this->createQueryBuilder('p')
                ->Where('p.libelle LIKE :val')
                ->orWhere('p.description LIKE :val')
                // le symbole '%' représente n'importe quelle séquence de caractères (y compris une séquence vide).
                ->setParameter('val', '%'.$value.'%')
                ->getQuery()
                ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Plat
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}
