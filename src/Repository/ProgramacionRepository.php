<?php

namespace App\Repository;

use App\Entity\Programacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Programacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programacion[]    findAll()
 * @method Programacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programacion::class);
    }
          public function programacionesOrdenadasDESC()
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
    //  * @return Programacion[] Returns an array of Programacion objects
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
    public function findOneBySomeField($value): ?Programacion
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
