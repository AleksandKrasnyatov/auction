<?php

declare(strict_types=1);

namespace App\Auth\Test\Unit\Entity\User;

use App\Auth\Entity\User\NetworkIdentity;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * covers NetworkIdentity
 */
class NetworkIdentityTest extends TestCase
{
    public function testSuccess(): void
    {
        $networkIdentity = new NetworkIdentity($network = 'google', $identity = 'google-1');

        self::assertEquals($network, $networkIdentity->getNetwork());
        self::assertEquals($identity, $networkIdentity->getIdentity());
    }

    public function testEmptyNetwork(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new NetworkIdentity('', 'google-1');
    }

    public function testEmptyIdentity(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new NetworkIdentity('google', '');
    }

    public function testEqual(): void
    {
        $networkIdentity = new NetworkIdentity($network = 'google', $identity = 'google-1');

        self::assertTrue($networkIdentity->isEqualTo(new NetworkIdentity($network, $identity)));
        self::assertFalse($networkIdentity->isEqualTo(new NetworkIdentity($network, 'google-2')));
        self::assertFalse($networkIdentity->isEqualTo(new NetworkIdentity('vk', 'vk-1')));
    }
}
