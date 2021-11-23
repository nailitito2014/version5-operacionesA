<?php

namespace App\Repository;

use App\Entity\Puerto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Puerto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Puerto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Puerto[]    findAll()
 * @method Puerto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PuertoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Puerto::class);
    }
     public function puertosOrdenadosDESC()
    {
        return $this->createQueryBuilder('p')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('p.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return Puerto[] Returns an array of Puerto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Puerto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
