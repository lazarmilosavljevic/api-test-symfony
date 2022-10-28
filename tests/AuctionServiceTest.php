<?php

namespace App\Tests;

use App\Entity\AuctionObject;
use App\Exception\NoBidsException;
use App\Repository\AuctionObjectRepository;
use App\Repository\BidRepository;
use App\Service\AuctionService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuctionServiceTest extends TestCase
{
    private MockObject $bidRepository;
    private AuctionService $service;
    private AuctionObject $auctionObject;

    public function setUp() :void
    {
        $this->auctionObject = new AuctionObject();
        $this->auctionObject->setName('test name');
        $this->auctionObject->setReservePrice(100);

        $auctionObjectRepository = $this->createMock(AuctionObjectRepository::class);
        $auctionObjectRepository->expects($this->any())
            ->method('findAll')
            ->willReturn([$this->auctionObject]);

        $this->bidRepository = $this->createMock(BidRepository::class);
        $this->service = new AuctionService($auctionObjectRepository, $this->bidRepository);
    }

    public function testGetWinnerWithResults()
    {
        $dataArray = [
            [
                'username' => 'test username',
                'max_price' => 120
            ],
            [
                'username' => 'test username',
                'max_price' => 110
            ]
        ];

        $expectedResult = [
            "winner" => "test username",
            "winning_price" => 110
        ];

        $this->bidRepository->expects($this->any())
            ->method('getWinner')
            ->with($this->auctionObject)
            ->willReturn($dataArray);

        $winnerResult = $this->service->getWinner();

        $this->assertIsArray($winnerResult);
        $this->assertEquals($expectedResult, $winnerResult);
    }

    public function testGetWinnerNoResults()
    {
        $this->bidRepository->expects($this->any())
            ->method('getWinner')
            ->with($this->auctionObject)
            ->willReturn([]);

        $this->expectException(NoBidsException::class);
        $this->service->getWinner();
    }

    public function testGetWinnerOneResult()
    {
        $dataArray = [
            [
                'username' => 'test username',
                'max_price' => 120
            ]
        ];

        $expectedResult = [
            "winner" => "test username",
            "winning_price" => 100
        ];

        $this->bidRepository->expects($this->any())
            ->method('getWinner')
            ->with($this->auctionObject)
            ->willReturn($dataArray);

        $winnerResult = $this->service->getWinner();

        $this->assertIsArray($winnerResult);
        $this->assertEquals($expectedResult, $winnerResult);
    }
}