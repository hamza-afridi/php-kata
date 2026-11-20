<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * Kata 3: PHP 8 Interfaces
 *
 * Like TypeScript interfaces but with explicit `implements` required.
 * Enforced at runtime, not just compile time.
 */
interface PaymentGatewayInterface
{
    public function charge(float $amount): bool;

    public function refund(string $transactionId): bool;

    public function getBalance(): float;
}
