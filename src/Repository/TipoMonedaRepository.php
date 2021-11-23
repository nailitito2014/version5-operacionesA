<?php

namespace App\Repository;

use App\Entity\TipoMoneda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoMoneda|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoMoneda|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoMoneda[]    findAll()
 * @method TipoMoneda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoMonedaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoMoneda::class);
    }
       public function tiposMonedasOrdenadasDESC()
    {
        return $this->createQueryBuilder('tm')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('tm.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return TipoMoneda[] Returns an array of TipoMoneda objects
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
    public function findOneBySomeField($value): ?TipoMoneda
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
