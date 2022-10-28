<?php

namespace App\Controller;

use App\Exception\NoBidsException;
use App\Service\AuctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetWinnerController extends AbstractController
{
    /**
     * @param AuctionService $service
     */
    public function __construct(private AuctionService $service)
    {}

    /**
     * @return JsonResponse
     * @throws NoBidsException
     */
    #[Route('/winner', name: 'get_winner')]
    public function getWinner(): JsonResponse
    {
        return $this->json($this->service->getWinner());
    }
}
