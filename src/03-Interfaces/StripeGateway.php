<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * Concrete implementation of PaymentGatewayInterface.
 *
 * MUST implement every method from the interface,
 * otherwise PHP throws a fatal error.
 */
class StripeGateway implements PaymentGatewayInterface
{
    private float $balance = 0.0;

    /** @var array<string, float> */
    private array $transactions = [];

    public function charge(float $amount): bool
    {
        if ($amount <= 0) {
            return false;
        }

        $transactionId = 'txn_' . uniqid();
        $this->transactions[$transactionId] = $amount;
        $this->balance += $amount;

        return true;
    }

    public function refund(string $transactionId): bool
    {
        if (!isset($this->transactions[$transactionId])) {
            return false;
        }

        $this->balance -= $this->transactions[$transactionId];
        unset($this->transactions[$transactionId]);

        return true;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getTransactionCount(): int
    {
        return count($this->transactions);
    }
}
