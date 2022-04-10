<?php

namespace App\Repository;

use App\Entity\Mullion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mullion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mullion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mullion[]    findAll()
 * @method Mullion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MullionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mullion::class);
    }

    // /**
    //  * @return Mullion[] Returns an array of Mullion objects
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
    public function findOneBySomeField($value): ?Mullion
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
