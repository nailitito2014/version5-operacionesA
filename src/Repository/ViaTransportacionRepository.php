<?php

namespace App\Repository;

use App\Entity\ViaTransportacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ViaRecepcion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ViaRecepcion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ViaRecepcion[]    findAll()
 * @method ViaRecepcion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViaTransportacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViaTransportacion::class);
    }
      public function viasTransportacionOrdenadasDESC()
    {
        return $this->createQueryBuilder('c')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('c.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return ViaRecepcion[] Returns an array of ViaRecepcion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ViaRecepcion
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
