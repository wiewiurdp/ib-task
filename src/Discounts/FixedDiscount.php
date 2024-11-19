<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Interfaces\ProductInterface;

class FixedDiscount extends AbstractDiscount
{
    /**
     * @param string[] $productCodeWhitelist
     */
    public function __construct(
        private readonly int $amount,
        array $productCodeWhitelist = []
    )
    {
        parent::__construct($productCodeWhitelist);
    }

    /**
     * @param ProductInterface[] $products
     */
    public function apply(array $products): int
    {
        foreach ($products as $product) {
            if ($this->isApplicable($product)) {
                return -$this->amount;
            }
        }
        return 0;
    }
}
