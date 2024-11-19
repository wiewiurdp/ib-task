<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Interfaces\ProductInterface;

class VolumeDiscount extends AbstractDiscount
{
    /**
     * @param string[] $productCodeWhitelist
     */
    public function __construct(
        private readonly int $minimumQuantity,
        private readonly int $amount,
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
        $totalQuantity = 0;
        foreach ($products as $product) {
            if ($this->isApplicable($product)) {
                $totalQuantity += $product->getQuantity();
            }
        }

        if ($totalQuantity >= $this->minimumQuantity) {
            return -$this->amount;
        }
        return 0;
    }
}
