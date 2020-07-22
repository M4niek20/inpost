<?php

namespace App\Repository;

use App\Entity\ProductOwners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductOwners|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOwners|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOwners[]    findAll()
 * @method ProductOwners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductOwnersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOwners::class);
    }

    // /**
    //  * @return ProductOwners[] Returns an array of ProductOwners objects
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
    public function findOneBySomeField($value): ?ProductOwners
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
