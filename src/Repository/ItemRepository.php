<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @extends ServiceEntityRepository<Item>
 *
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

     /**
    * @return Item[]
    */
    public function getArchivedItems(EntityManagerInterface $entityManager): array
    {
        return $entityManager->createQuery(
            'SELECT i 
            FROM App\Entity\Item i 
            WHERE i.isArchived = true')->getResult();

    }

    /**
    * @return Item[]
    */
    public function getNonValidatedItems(EntityManagerInterface $entityManager): array
    {
        return $entityManager->createQuery(
            'SELECT i 
            FROM App\Entity\Item i 
            WHERE i.isArchived = false 
            AND i.isValidated = false')->getResult();

    }
    
    /**
    * @return Item[]
    */
    public function findValidableItem(int $id): array
    {
        return $this->createQueryBuilder('i')
                   ->andWhere('i.id = :id')
                   ->setParameter('id', $id)
                   ->andWhere('i.isValidated = false')
                   ->andWhere('i.isArchived = false')
                   ->getQuery()
                   ->getResult();
    }

//    /**
//     * @return Item[] Returns an array of Item objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Item
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
