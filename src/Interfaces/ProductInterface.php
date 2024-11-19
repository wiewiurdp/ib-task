<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ProductInterface
{
    public function getCode(): string;
    public function getPrice(): PriceInterface;
    public function getQuantity(): int;
}
