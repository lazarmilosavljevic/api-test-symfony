<?php

namespace App\Repository;

use App\Entity\AuctionObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AuctionObject>
 *
 * @method AuctionObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuctionObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuctionObject[]    findAll()
 * @method AuctionObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuctionObjectRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuctionObject::class);
    }
}
