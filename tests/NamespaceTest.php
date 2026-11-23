<?php

declare(strict_types=1);

namespace Tests;

use App\Classes\Product;
use App\Namespaces\Shipping\Calculator;
use PHPUnit\Framework\TestCase;

class NamespaceTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testShippingChargedUnderThreshold(): void
    {
        $products = [
            new Product('Small Tile', 9.99, 'ST-001'),
        ];

        $this->assertSame(4.99, $this->calculator->calculateShipping($products));
    }

    public function testFreeShippingOverThreshold(): void
    {
        $products = [
            new Product('Premium Tile', 30.00, 'PT-001'),
            new Product('Grout', 25.00, 'GR-001'),
        ];

        $this->assertSame(0.0, $this->calculator->calculateShipping($products));
    }

    public function testOrderSummaryStructure(): void
    {
        $products = [
            new Product('Metro Tile', 12.99, 'MT-001'),
            new Product('Adhesive', 8.50, 'AD-001'),
        ];

        $summary = $this->calculator->getOrderSummary($products);

        $this->assertArrayHasKey('subtotal', $summary);
        $this->assertArrayHasKey('shipping', $summary);
        $this->assertArrayHasKey('total', $summary);
    }
}
