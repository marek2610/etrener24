<?php

namespace App\Repository;

use App\Entity\Przeciwnik;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Przeciwnik|null find($id, $lockMode = null, $lockVersion = null)
 * @method Przeciwnik|null findOneBy(array $criteria, array $orderBy = null)
 * @method Przeciwnik[]    findAll()
 * @method Przeciwnik[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrzeciwnikRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Przeciwnik::class);
    }

    // /**
    //  * @return Przeciwnik[] Returns an array of Przeciwnik objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Przeciwnik
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
