<?php

declare(strict_types=1);

namespace Tests;

use App\Classes\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private Product $product;

    protected function setUp(): void
    {
        $this->product = new Product('Metro Tile', 12.99, 'MT-001');
    }

    public function testConstructorSetsProperties(): void
    {
        $this->assertSame('Metro Tile', $this->product->getName());
        $this->assertSame(12.99, $this->product->getPrice());
        $this->assertSame('MT-001', $this->product->sku);
    }

    public function testDefaultCategory(): void
    {
        $this->assertSame('general', $this->product->getCategory());
    }

    public function testCustomCategory(): void
    {
        $product = new Product('Wall Tile', 9.99, 'WT-001', 'wall');
        $this->assertSame('wall', $product->getCategory());
    }

    public function testWithPriceReturnsNewInstance(): void
    {
        $updated = $this->product->withPrice(15.99);

        $this->assertSame(15.99, $updated->getPrice());
        $this->assertSame(12.99, $this->product->getPrice()); // original unchanged
        $this->assertNotSame($this->product, $updated);
    }

    public function testGetPriceWithTax(): void
    {
        $this->assertSame(15.59, $this->product->getPriceWithTax());
        $this->assertSame(14.29, $this->product->getPriceWithTax(0.10));
    }

    public function testStaticFactoryCreate(): void
    {
        $product = Product::create('Slate', 24.99, 'SL-001');

        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame('Slate', $product->getName());
    }

    public function testToString(): void
    {
        $this->assertSame('Metro Tile (MT-001): £12.99', (string) $this->product);
    }
}
