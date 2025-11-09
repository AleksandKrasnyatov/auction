<?php

declare(strict_types=1);

namespace App\Auth\Test\Unit\Entity\User\User\JoinByEmail;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Token;
use App\Auth\Entity\User\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * covers User
 */
class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::requestJoinByEmail(
            $id = Id::generate(),
            $date = new DateTimeImmutable(),
            $email = new Email('user@mail.ru'),
            $hash = 'hash',
            $token = new Token(Uuid::uuid4()->toString(), new DateTimeImmutable())
        );

        self::assertSame($id, $user->getId());
        self::assertSame($date, $user->getDate());
        self::assertSame($email, $user->getEmail());
        self::assertSame($hash, $user->getPasswordHash());
        self::assertSame($token, $user->getJoinConfirmToken());

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }
}
