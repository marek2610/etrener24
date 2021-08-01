<?php

namespace App\Repository;

use App\Entity\Sezon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sezon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sezon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sezon[]    findAll()
 * @method Sezon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SezonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sezon::class);
    }

    // /**
    //  * @return Sezon[] Returns an array of Sezon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sezon
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
