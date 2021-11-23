<?php

namespace App\Repository;

use App\Entity\Traza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Traza|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traza|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traza[]    findAll()
 * @method Traza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrazaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Traza::class);
    }

    // /**
    //  * @return Traza[] Returns an array of Traza objects
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
    public function findOneBySomeField($value): ?Traza
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
