<?php

namespace App\Repository;

use App\Entity\Krew;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Krew|null find($id, $lockMode = null, $lockVersion = null)
 * @method Krew|null findOneBy(array $criteria, array $orderBy = null)
 * @method Krew[]    findAll()
 * @method Krew[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KrewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Krew::class);
    }

    // /**
    //  * @return Krew[] Returns an array of Krew objects
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
    public function findOneBySomeField($value): ?Krew
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
