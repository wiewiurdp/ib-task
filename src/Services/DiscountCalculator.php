<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\DiscountInterface;
use App\Interfaces\ProductInterface;

readonly class DiscountCalculator
{
    /**
     * @param DiscountInterface[] $discounts
     */
    public function __construct(
        private array $discounts,
    ) {}

    /**
     * @param ProductInterface[] $products
     */
    public function calculateTotal(array $products): int
    {
        $totalValue = 0;

        foreach ($products as $product) {
            $totalValue += $product->getPrice()->getAmount() * $product->getQuantity();
        }

        foreach ($this->discounts as $discount) {
            $totalValue += $discount->apply($products);
        }

        return $totalValue;
    }
}
