<?php

namespace App\Repository;

use App\Entity\PrintType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrintType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrintType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrintType[]    findAll()
 * @method PrintType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrintTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrintType::class);
    }

    // /**
    //  * @return PrintType[] Returns an array of PrintType objects
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
    public function findOneBySomeField($value): ?PrintType
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
