<?php

declare(strict_types=1);

namespace App\Auth\Command\ResetPassword\Reset;

use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\PasswordHasher;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    private Flusher $flusher;
    private UserRepository $users;
    private PasswordHasher $hasher;

    public function __construct(
        UserRepository $users,
        PasswordHasher $hasher,
        Flusher $flusher
    ) {
        $this->flusher = $flusher;
        $this->users = $users;
        $this->hasher = $hasher;
    }

    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByPasswordResetToken($command->token)) {
            throw new DomainException('Token is not found.');
        }

        $user->resetPassword(
            $command->token,
            new DateTimeImmutable(),
            $this->hasher->hash($command->password)
        );

        $this->flusher->flush();
    }
}
