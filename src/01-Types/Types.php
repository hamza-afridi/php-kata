<?php

declare(strict_types=1);

namespace App\Types;

/**
 * Kata 1: PHP 8 Type System
 *
 * JS comparison:
 *   JS:  function add(a, b) { return a + b; }     // no type safety
 *   TS:  function add(a: number, b: number): number // compile-time only
 *   PHP: function add(int $a, int $b): int          // enforced at runtime with strict_types
 */
class Types
{
    // 1. Scalar types: int, float, string, bool
    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    public function concat(string $first, string $second): string
    {
        return $first . ' ' . $second;
    }

    public function isAdult(int $age): bool
    {
        return $age >= 18;
    }

    // 2. Nullable types — like TypeScript's `string | null`
    public function findUser(int $id): ?string
    {
        $users = [1 => 'Hamza', 2 => 'Anees', 3 => 'Ali'];

        return $users[$id] ?? null;
    }

    // 3. Union types (PHP 8.0) — like TypeScript's `string | int`
    public function formatId(string|int $id): string
    {
        return "ID-{$id}";
    }

    // 4. Array type hint
    public function sum(array $numbers): float
    {
        return array_sum($numbers);
    }

    // 5. Return type: void
    public function logMessage(string $message): void
    {
        // In a real app you'd write to a log file
    }

    // 6. Mixed type (PHP 8.0) — like TypeScript's `any`
    public function identity(mixed $value): mixed
    {
        return $value;
    }
}
