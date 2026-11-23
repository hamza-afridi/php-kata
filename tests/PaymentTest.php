<?php

declare(strict_types=1);

namespace Tests;

use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\StripeGateway;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    private StripeGateway $gateway;

    protected function setUp(): void
    {
        $this->gateway = new StripeGateway();
    }

    public function testImplementsInterface(): void
    {
        $this->assertInstanceOf(PaymentGatewayInterface::class, $this->gateway);
    }

    public function testChargeIncreasesBalance(): void
    {
        $this->assertTrue($this->gateway->charge(49.99));
        $this->assertSame(49.99, $this->gateway->getBalance());
    }

    public function testChargeRejectsZeroOrNegative(): void
    {
        $this->assertFalse($this->gateway->charge(0));
        $this->assertFalse($this->gateway->charge(-10));
        $this->assertSame(0.0, $this->gateway->getBalance());
    }

    public function testMultipleChargesAccumulate(): void
    {
        $this->gateway->charge(10.0);
        $this->gateway->charge(20.0);

        $this->assertSame(30.0, $this->gateway->getBalance());
        $this->assertSame(2, $this->gateway->getTransactionCount());
    }

    public function testRefundNonExistentReturnsFalse(): void
    {
        $this->assertFalse($this->gateway->refund('txn_fake'));
    }
}
