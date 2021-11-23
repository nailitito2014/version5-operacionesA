<?php

namespace App\Repository;

use App\Entity\ImportaCubano;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportaCubano|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportaCubano|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportaCubano[]    findAll()
 * @method ImportaCubano[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportaCubanoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportaCubano::class);
    }
       public function importacionesCubanasOrdenadasDESC()
    {
        return $this->createQueryBuilder('ic')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('ic.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }
    
    
    
    
    
    

    // /**
    //  * @return ImportaCubano[] Returns an array of ImportaCubano objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImportaCubano
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
