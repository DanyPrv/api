<?php

namespace App\Repository;

use App\Entity\HardwareRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HardwareRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method HardwareRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method HardwareRequest[]    findAll()
 * @method HardwareRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HardwareRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HardwareRequest::class);
    }

    // /**
    //  * @return HardwareRequest[] Returns an array of HardwareRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HardwareRequest
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return HardwareRequest[] Returns an array of HardwareRequest objects
     */
    public function findByUserField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.owner = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
}
