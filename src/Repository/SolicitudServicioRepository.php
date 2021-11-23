<?php

namespace App\Repository;

use App\Entity\SolicitudServicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SolicitudServicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method SolicitudServicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method SolicitudServicio[]    findAll()
 * @method SolicitudServicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitudServicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SolicitudServicio::class);
    }
     public function solicitudesServicioOrdenadasDESC()
    {
        return $this->createQueryBuilder('s')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('s.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }
    // /**
    //  * @return SolicitudServicio[] Returns an array of SolicitudServicio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SolicitudServicio
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
