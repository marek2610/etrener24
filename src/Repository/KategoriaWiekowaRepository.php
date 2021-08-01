<?php

namespace App\Repository;

use App\Entity\KategoriaWiekowa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KategoriaWiekowa|null find($id, $lockMode = null, $lockVersion = null)
 * @method KategoriaWiekowa|null findOneBy(array $criteria, array $orderBy = null)
 * @method KategoriaWiekowa[]    findAll()
 * @method KategoriaWiekowa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KategoriaWiekowaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KategoriaWiekowa::class);
    }

    // /**
    //  * @return KategoriaWiekowa[] Returns an array of KategoriaWiekowa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KategoriaWiekowa
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
