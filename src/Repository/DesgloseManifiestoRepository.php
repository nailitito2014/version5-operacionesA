<?php

namespace App\Repository;

use App\Entity\DesgloseManifiesto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DesgloseManifiesto|null find($id, $lockMode = null, $lockVersion = null)
 * @method DesgloseManifiesto|null findOneBy(array $criteria, array $orderBy = null)
 * @method DesgloseManifiesto[]    findAll()
 * @method DesgloseManifiesto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesgloseManifiestoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DesgloseManifiesto::class);
    }
       public function desglosesManifiestoOrdenadosDESC()
    {
        return $this->createQueryBuilder('d')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('d.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return DesgloseManifiesto[] Returns an array of DesgloseManifiesto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DesgloseManifiesto
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
