<?php

declare(strict_types=1);

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Models\Price;
use App\Models\Product;
use App\Discounts\FixedDiscount;
use App\Discounts\PercentageDiscount;
use App\Discounts\VolumeDiscount;
use App\Services\DiscountCalculator;

class DiscountCalculatorTest extends TestCase
{
    public function testCalculateTotal(): void
    {
        $products = [
            new Product('Product1', new Price(100, 'PLN'), 3),
            new Product('Product2', new Price(200, 'PLN'), 15),
        ];

        $discounts = [
            new FixedDiscount(100),
            new PercentageDiscount(10),
            new VolumeDiscount(10, 100),
        ];

        $calculator = new DiscountCalculator($discounts);
        $total = $calculator->calculateTotal($products);

        $this->assertEquals(2770, $total);
    }

    public function testNoDiscounts(): void
    {
        $products = [
            new Product('Product1', new Price(100, 'PLN'), 3),
        ];

        $discounts = [];
        $calculator = new DiscountCalculator($discounts);
        $total = $calculator->calculateTotal($products);

        $this->assertEquals(300, $total);
    }

    public function testproductCodeWhitelist(): void
    {
        $products = [
            new Product('Product1', new Price(100, 'PLN'), 3),
            new Product('Product2', new Price(200, 'PLN'), 15),
            new Product('Product3', new Price(300, 'PLN'), 1),
        ];

        $discounts = [
            new FixedDiscount(100, ['Product1', 'Product2']),
            new PercentageDiscount(10, ['Product1', 'Product2']),
            new VolumeDiscount(10, 100, ['Product1', 'Product2']),
        ];

        $calculator = new DiscountCalculator($discounts);
        $total = $calculator->calculateTotal($products);

        $this->assertEquals(3070, $total);
    }
}

