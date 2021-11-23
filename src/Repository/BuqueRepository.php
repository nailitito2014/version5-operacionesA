<?php

namespace App\Repository;

use App\Entity\Buque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Buque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Buque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Buque[]    findAll()
 * @method Buque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Buque::class);
    }
     public function buquesOrdenadosDESC()
    {
        return $this->createQueryBuilder('b')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('b.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return Buque[] Returns an array of Buque objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Buque
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
