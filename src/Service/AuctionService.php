<?php

namespace App\Service;

use App\Entity\AuctionObject;
use App\Exception\NoBidsException;
use App\Repository\AuctionObjectRepository;
use App\Repository\BidRepository;

class AuctionService
{
    private AuctionObject $auctionObject;

    /**
     * @param AuctionObjectRepository $auctionObjectRepository
     * @param BidRepository $bidRepository
     */
    public function __construct(
        private AuctionObjectRepository $auctionObjectRepository,
        private BidRepository $bidRepository
    )
    {
        // for example, let's take this auction object
        $this->auctionObject = $this->auctionObjectRepository->findAll()[0];
    }

    /**
     * @return array
     * @throws NoBidsException
     */
    public function getWinner(): array
    {
        $winner = $this->bidRepository->getWinner($this->auctionObject);

        if (empty($winner)) {
            throw new NoBidsException();
        }

        return [
            'winner' => $winner[0]['username'],
            'winning_price' => (isset($winner[1])) ?
                max($winner[1]['max_price'], $this->auctionObject->getReservePrice()) : $this->auctionObject->getReservePrice()
        ];
    }
}