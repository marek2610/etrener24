<?php

namespace App\Repository;

use App\Entity\Konspekt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Konspekt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Konspekt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Konspekt[]    findAll()
 * @method Konspekt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KonspektRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Konspekt::class);
    }

    // /**
    //  * @return Konspekt[] Returns an array of Konspekt objects
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
    public function findOneBySomeField($value): ?Konspekt
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
