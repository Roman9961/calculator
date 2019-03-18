<?php

namespace App\Repository;

use App\Entity\PostPrint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostPrint|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostPrint|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostPrint[]    findAll()
 * @method PostPrint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostPrintRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostPrint::class);
    }

    // /**
    //  * @return PostPrint[] Returns an array of PostPrint objects
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
    public function findOneBySomeField($value): ?PostPrint
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
