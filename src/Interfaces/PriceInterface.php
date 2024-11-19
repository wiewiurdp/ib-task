<?php

declare(strict_types=1);

namespace App\Interfaces;

interface PriceInterface
{
    public function getAmount(): int;

    public function getCurrency(): string;
}
