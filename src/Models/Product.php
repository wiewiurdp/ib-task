<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\PriceInterface;
use App\Interfaces\ProductInterface;

readonly class Product implements ProductInterface
{
    public function __construct(
        private string         $code,
        private PriceInterface $price,
        private int            $quantity,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPrice(): PriceInterface
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
