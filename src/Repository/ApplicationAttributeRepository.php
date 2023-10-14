<?php

namespace App\Repository;

use App\Entity\ApplicationAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicationAttribute>
 *
 * @method ApplicationAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationAttribute[]    findAll()
 * @method ApplicationAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationAttribute::class);
    }

//    /**
//     * @return ApplicationAttribute[] Returns an array of ApplicationAttribute objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ApplicationAttribute
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
