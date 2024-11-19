<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Interfaces\DiscountInterface;
use App\Interfaces\ProductInterface;

abstract class AbstractDiscount implements DiscountInterface
{
    /**
     * @var string[]
     */
    protected array $productCodeWhitelist;

    /**
     * @param string[] $productCodeWhitelist
     */
    public function __construct(array $productCodeWhitelist = [])
    {
        $this->productCodeWhitelist = $productCodeWhitelist;
    }

    public function isApplicable(ProductInterface $product): bool
    {
        return empty($this->productCodeWhitelist) || in_array($product->getCode(), $this->productCodeWhitelist);
    }
}
