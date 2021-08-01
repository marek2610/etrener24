<?php

namespace App\Repository;

use App\Entity\Treningi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Treningi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Treningi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Treningi[]    findAll()
 * @method Treningi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TreningiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Treningi::class);
    }

    // /**
    //  * @return Treningi[] Returns an array of Treningi objects
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
    public function findOneBySomeField($value): ?Treningi
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
