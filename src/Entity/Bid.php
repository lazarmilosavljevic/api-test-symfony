<?php

namespace App\Entity;

use App\Repository\BidRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BidRepository::class)]
#[ORM\Table(name: 'bid')]
class Bid
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private float $price;

    #[ORM\ManyToOne(targetEntity: AuctionObject::class, inversedBy: 'bids')]
    private ?AuctionObject $auctionObject;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bids')]
    private ?User $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return AuctionObject|null
     */
    public function getAuctionObject(): ?AuctionObject
    {
        return $this->auctionObject;
    }

    /**
     * @param AuctionObject|null $auctionObject
     * @return $this
     */
    public function setAuctionObject(?AuctionObject $auctionObject): self
    {
        $this->auctionObject = $auctionObject;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}