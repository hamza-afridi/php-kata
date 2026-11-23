<?php

declare(strict_types=1);

namespace Tests;

use App\PSR\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    private Logger $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
    }

    public function testInfoLogsMessage(): void
    {
        $this->logger->info('Application started');

        $last = $this->logger->getLastLog();

        $this->assertSame('info', $last['level']);
        $this->assertSame('Application started', $last['message']);
    }

    public function testErrorLogsMessage(): void
    {
        $this->logger->error('Something broke');

        $this->assertSame('error', $this->logger->getLastLog()['level']);
    }

    public function testPsr3Interpolation(): void
    {
        $this->logger->info('User {name} logged in from {ip}', [
            'name' => 'Hamza',
            'ip' => '192.168.1.1',
        ]);

        $last = $this->logger->getLastLog();

        $this->assertSame('User Hamza logged in from 192.168.1.1', $last['message']);
    }

    public function testMultipleLogLevels(): void
    {
        $this->logger->debug('Debug msg');
        $this->logger->info('Info msg');
        $this->logger->warning('Warning msg');
        $this->logger->error('Error msg');

        $logs = $this->logger->getLogs();

        $this->assertCount(4, $logs);
        $this->assertSame('debug', $logs[0]['level']);
        $this->assertSame('error', $logs[3]['level']);
    }

    public function testGetLastLogReturnsNullWhenEmpty(): void
    {
        $this->assertNull($this->logger->getLastLog());
    }
}
