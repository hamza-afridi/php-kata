<?php

declare(strict_types=1);

namespace Tests;

use App\Types\Types;
use PHPUnit\Framework\TestCase;

class TypesTest extends TestCase
{
    private Types $types;

    protected function setUp(): void
    {
        $this->types = new Types();
    }

    public function testAddReturnsSumOfIntegers(): void
    {
        $this->assertSame(5, $this->types->add(2, 3));
        $this->assertSame(0, $this->types->add(-1, 1));
    }

    public function testConcatJoinsStrings(): void
    {
        $this->assertSame('Hello World', $this->types->concat('Hello', 'World'));
    }

    public function testIsAdultReturnsCorrectBoolean(): void
    {
        $this->assertTrue($this->types->isAdult(18));
        $this->assertFalse($this->types->isAdult(17));
    }

    public function testFindUserReturnsNameOrNull(): void
    {
        $this->assertSame('Hamza', $this->types->findUser(1));
        $this->assertNull($this->types->findUser(999));
    }

    public function testFormatIdAcceptsStringOrInt(): void
    {
        $this->assertSame('ID-42', $this->types->formatId(42));
        $this->assertSame('ID-abc', $this->types->formatId('abc'));
    }

    public function testSumCalculatesArrayTotal(): void
    {
        $this->assertSame(10.0, $this->types->sum([1, 2, 3, 4]));
        $this->assertSame(0.0, $this->types->sum([]));
    }

    public function testIdentityReturnsInputUnchanged(): void
    {
        $this->assertSame(42, $this->types->identity(42));
        $this->assertSame('hello', $this->types->identity('hello'));
        $this->assertNull($this->types->identity(null));
    }
}
