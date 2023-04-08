<?php

namespace App\Repository;

use App\Entity\MenuLinkDish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MenuLinkDish>
 *
 * @method MenuLinkDish|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuLinkDish|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuLinkDish[]    findAll()
 * @method MenuLinkDish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuLinkDishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuLinkDish::class);
    }

    public function save(MenuLinkDish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MenuLinkDish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MenuLinkDish[] Returns an array of MenuLinkDish objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MenuLinkDish
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
