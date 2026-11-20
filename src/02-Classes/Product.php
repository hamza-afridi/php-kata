<?php

declare(strict_types=1);

namespace App\Classes;

/**
 * Kata 2: PHP 8 Classes
 *
 * JS comparison:
 *   class Product {
 *       #price;
 *       constructor(name, price, sku) {
 *           this.name = name;
 *           this.#price = price;
 *           this.sku = sku;
 *       }
 *   }
 *
 * PHP 8 constructor promotion removes the boilerplate.
 */
class Product
{
    public function __construct(
        private string $name,
        private float $price,
        public readonly string $sku,
        protected string $category = 'general'
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function withPrice(float $newPrice): self
    {
        return new self(
            $this->name,
            $newPrice,
            $this->sku,
            $this->category
        );
    }

    public function getPriceWithTax(float $taxRate = 0.20): float
    {
        return round($this->price * (1 + $taxRate), 2);
    }

    public static function create(string $name, float $price, string $sku): self
    {
        return new self($name, $price, $sku);
    }

    public function __toString(): string
    {
        return "{$this->name} ({$this->sku}): £{$this->price}";
    }
}
