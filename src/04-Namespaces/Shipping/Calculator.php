<?php

declare(strict_types=1);

namespace App\Namespaces\Shipping;

use App\Classes\Product;

/**
 * Kata 4: Namespaces
 *
 * JS:   import { Product } from '../02-Classes/Product';
 * PHP:  use App\Classes\Product;
 *
 * Composer PSR-4 maps App\ -> src/
 */
class Calculator
{
    private const BASE_SHIPPING = 4.99;
    private const FREE_SHIPPING_THRESHOLD = 50.0;

    /** @param Product[] $products */
    public function calculateShipping(array $products): float
    {
        $total = 0.0;

        foreach ($products as $product) {
            $total += $product->getPrice();
        }

        if ($total >= self::FREE_SHIPPING_THRESHOLD) {
            return 0.0;
        }

        return self::BASE_SHIPPING;
    }

    /** @param Product[] $products */
    public function getOrderSummary(array $products): array
    {
        $subtotal = 0.0;

        foreach ($products as $product) {
            $subtotal += $product->getPrice();
        }

        $shipping = $this->calculateShipping($products);

        return [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ];
    }
}
