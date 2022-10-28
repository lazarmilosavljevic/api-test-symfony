<?php

namespace App\DataFixtures;

use App\Entity\AuctionObject;
use App\Entity\Bid;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $userA = new User;
        $userA->setUsername('A');
        $manager->persist($userA);

        $userB = new User;
        $userB->setUsername('B');
        $manager->persist($userB);

        $userC = new User;
        $userC->setUsername('C');
        $manager->persist($userC);

        $userD = new User;
        $userD->setUsername('D');
        $manager->persist($userD);

        $userE = new User;
        $userE->setUsername('E');
        $manager->persist($userE);

        $auctionObject = new AuctionObject;
        $auctionObject->setName('this is for sale!');
        $auctionObject->setReservePrice(100);
        $manager->persist($auctionObject);

        $bidA1 = new Bid;
        $bidA1->setUser($userA);
        $bidA1->setPrice(110);
        $bidA1->setAuctionObject($auctionObject);
        $manager->persist($bidA1);

        $bidA2 = new Bid;
        $bidA2->setUser($userA);
        $bidA2->setPrice(130);
        $bidA2->setAuctionObject($auctionObject);
        $manager->persist($bidA2);

        $bidC1 = new Bid;
        $bidC1->setUser($userC);
        $bidC1->setPrice(125);
        $bidC1->setAuctionObject($auctionObject);
        $manager->persist($bidC1);

        $bidD1 = new Bid;
        $bidD1->setUser($userD);
        $bidD1->setPrice(105);
        $bidD1->setAuctionObject($auctionObject);
        $manager->persist($bidD1);

        $bidD2 = new Bid;
        $bidD2->setUser($userD);
        $bidD2->setPrice(115);
        $bidD2->setAuctionObject($auctionObject);
        $manager->persist($bidD2);

        $bidD3 = new Bid;
        $bidD3->setUser($userD);
        $bidD3->setPrice(90);
        $bidD3->setAuctionObject($auctionObject);
        $manager->persist($bidD3);

        $bidE1 = new Bid;
        $bidE1->setUser($userE);
        $bidE1->setPrice(132);
        $bidE1->setAuctionObject($auctionObject);
        $manager->persist($bidE1);

        $bidE2 = new Bid;
        $bidE2->setUser($userE);
        $bidE2->setPrice(135);
        $bidE2->setAuctionObject($auctionObject);
        $manager->persist($bidE2);

        $bidE3 = new Bid;
        $bidE3->setUser($userE);
        $bidE3->setPrice(140);
        $bidE3->setAuctionObject($auctionObject);
        $manager->persist($bidE3);

        $manager->flush();
    }
}
