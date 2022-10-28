<?php

namespace App\Repository;

use App\Entity\AuctionObject;
use App\Entity\Bid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bid>
 *
 * @method Bid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bid[]    findAll()
 * @method Bid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BidRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bid::class);
    }

    /**
     * @param AuctionObject $auctionObject
     * @return array
     */
    public function getWinner(AuctionObject $auctionObject): array
    {
        $query = $this->createQueryBuilder('b')
            ->select('u.username, MAX(b.price) AS max_price')
            ->leftJoin('b.user', 'u')
            ->where('b.auctionObject = :auctionObject')->setParameter('auctionObject', $auctionObject)
            ->groupBy('u.username')
            ->setMaxResults(2)
            ->orderBy('max_price', 'DESC');

        return $query->getQuery()->getResult();
    }
}
