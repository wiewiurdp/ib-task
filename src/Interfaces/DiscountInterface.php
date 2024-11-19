<?php

declare(strict_types=1);

namespace App\Interfaces;

interface DiscountInterface
{
    public function isApplicable(ProductInterface $product): bool;

    /**
     * @param ProductInterface[] $products
     */
    public function apply(array $products): int;
}
