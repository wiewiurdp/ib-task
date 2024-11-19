<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Interfaces\ProductInterface;

class PercentageDiscount extends AbstractDiscount
{
    /**
     * @param string[] $productCodeWhitelist
     */
    public function __construct(
        private readonly float $percentage,
        array $productCodeWhitelist = [],
    )
    {
        parent::__construct($productCodeWhitelist);
    }

    /**
     * @param ProductInterface[] $products
     */
    public function apply(array $products): int
    {
        $total = 0;
        foreach ($products as $product) {
            if ($this->isApplicable($product)) {
                $total += $product->getPrice()->getAmount() * $product->getQuantity();
            }
        }
        return -(int)($total * $this->percentage / 100);
    }
}
