<?php

namespace App\Exception;

class NoBidsException extends \Exception
{
    protected $message = 'Currently, there are no bids for this auction.';
}
