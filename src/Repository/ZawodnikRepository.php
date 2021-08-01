<?php

namespace App\Repository;

use App\Entity\Zawodnik;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zawodnik|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zawodnik|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zawodnik[]    findAll()
 * @method Zawodnik[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZawodnikRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zawodnik::class);
    }

    // /**
    //  * @return Zawodnik[] Returns an array of Zawodnik objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zawodnik
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
