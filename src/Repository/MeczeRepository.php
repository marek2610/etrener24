<?php

namespace App\Repository;

use App\Entity\Mecze;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mecze|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mecze|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mecze[]    findAll()
 * @method Mecze[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeczeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mecze::class);
    }

    // /**
    //  * @return Mecze[] Returns an array of Mecze objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mecze
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
