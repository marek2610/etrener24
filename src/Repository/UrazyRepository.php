<?php

namespace App\Repository;

use App\Entity\Urazy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Urazy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Urazy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Urazy[]    findAll()
 * @method Urazy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrazyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Urazy::class);
    }

    // /**
    //  * @return Urazy[] Returns an array of Urazy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Urazy
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
