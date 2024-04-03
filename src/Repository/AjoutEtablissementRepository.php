<?php

namespace App\Repository;

use App\Entity\AjoutEtablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AjoutEtablissement>
 *
 * @method AjoutEtablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method AjoutEtablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method AjoutEtablissement[]    findAll()
 * @method AjoutEtablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AjoutEtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AjoutEtablissement::class);
    }

//    /**
//     * @return AjoutEtablissement[] Returns an array of AjoutEtablissement objects
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

//    public function findOneBySomeField($value): ?AjoutEtablissement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
