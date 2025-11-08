<?php

declare(strict_types=1);

namespace App\Auth\Test\Unit\Entity\User;

use App\Auth\Entity\User\Status;
use PHPUnit\Framework\TestCase;

/**
 * covers Status
 */
class StatusTest extends TestCase
{
    public function testWait(): void
    {
        $status = Status::wait();
        $this->assertTrue($status->isWait());
        $this->assertFalse($status->isActive());
    }

    public function testActive(): void
    {
        $status = Status::active();
        $this->assertTrue($status->isActive());
        $this->assertFalse($status->isWait());
    }
}
