<?php

namespace App\Repository;

use App\Entity\Trenerzy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trenerzy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trenerzy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trenerzy[]    findAll()
 * @method Trenerzy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrenerzyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trenerzy::class);
    }

    // /**
    //  * @return Trenerzy[] Returns an array of Trenerzy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trenerzy
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
