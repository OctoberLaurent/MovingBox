<?php

namespace App\Repository;

use App\Entity\Boxes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Boxes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boxes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boxes[]    findAll()
 * @method Boxes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoxesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Boxes::class);
    }

    /**
    * 
    *
    */
    public function findMaxNumber($id)
    {
        $rawSql = "SELECT MAX(`number`) FROM boxes WHERE `user_id` = ".$id;

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll()[0]["MAX(`number`)"];
    }

    /*
    public function findOneBySomeField($value): ?Boxes
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
