<?php

namespace App\Repository;

use App\Entity\CorridorPolygon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CorridorPolygon|null find($id, $lockMode = null, $lockVersion = null)
 * @method CorridorPolygon|null findOneBy(array $criteria, array $orderBy = null)
 * @method CorridorPolygon[]    findAll()
 * @method CorridorPolygon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorridorPolygonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CorridorPolygon::class);
    }

    // /**
    //  * @return CorridorPolygon[] Returns an array of CorridorPolygon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CorridorPolygon
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
