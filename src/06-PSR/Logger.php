<?php

declare(strict_types=1);

namespace App\PSR;

/**
 * Kata 6: PSR Standards
 *
 * Follows PSR-1 (one class per file), PSR-4 (autoloading),
 * PSR-12 (coding style), and PSR-3 (logger interface pattern).
 */
class Logger
{
    /** @var array<array{level: string, message: string, context: array}> */
    private array $logs = [];

    public function info(string $message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    public function debug(string $message, array $context = []): void
    {
        $this->log('debug', $message, $context);
    }

    private function log(string $level, string $message, array $context): void
    {
        $this->logs[] = [
            'level' => $level,
            'message' => $this->interpolate($message, $context),
            'context' => $context,
        ];
    }

    /**
     * PSR-3 style: replaces {placeholder} with context values.
     * Example: "User {name} logged in" + ['name' => 'Hamza'] -> "User Hamza logged in"
     */
    private function interpolate(string $message, array $context): string
    {
        $replace = [];

        foreach ($context as $key => $value) {
            $replace['{' . $key . '}'] = (string) $value;
        }

        return strtr($message, $replace);
    }

    /** @return array<array{level: string, message: string, context: array}> */
    public function getLogs(): array
    {
        return $this->logs;
    }

    public function getLastLog(): ?array
    {
        if (empty($this->logs)) {
            return null;
        }

        return $this->logs[array_key_last($this->logs)];
    }
}
