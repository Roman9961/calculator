<?php

namespace App\Repository;

use App\Entity\Coat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Coat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coat[]    findAll()
 * @method Coat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Coat::class);
    }

    // /**
    //  * @return Coat[] Returns an array of Coat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Coat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
