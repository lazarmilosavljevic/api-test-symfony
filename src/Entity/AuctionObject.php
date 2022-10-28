<?php

namespace App\Entity;

use App\Repository\AuctionObjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: AuctionObjectRepository::class)]
#[ORM\Table(name: 'auction_object')]
#[UniqueEntity('name')]
class AuctionObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, unique: true)]
    private string $name;

    #[ORM\Column]
    private float $reservePrice;

    #[ORM\OneToMany(mappedBy: 'auctionObject', targetEntity: Bid::class)]
    private $bids;

    public function __construct()
    {
        $this->bids = new ArrayCollection();
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getReservePrice(): float
    {
        return $this->reservePrice;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setReservePrice(float $price): self
    {
        $this->reservePrice = $price;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getBids(): Collection
    {
        return $this->bids;
    }

    /**
     * @param Bid $bid
     * @return $this
     */
    public function addBid(Bid $bid): self
    {
        if (!$this->bids->contains($bid)) {
            $this->bids[] = $bid;
            $bid->setAuctionObject($this);
        }

        return $this;
    }

    /**
     * @param Bid $bid
     * @return $this
     */
    public function removeBid(Bid $bid): self
    {
        if ($this->bids->contains($bid)) {
            $this->bids->removeElement($bid);
            // set the owning side to null (unless already changed)
            if ($bid->getAuctionObject() === $this) {
                $bid->setAuctionObject(null);
            }
        }

        return $this;
    }
}
