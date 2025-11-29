<?php

declare(strict_types=1);

namespace App\Auth\Command\ChangeEmail\Confirm;

use App\Auth\Entity\User\UserRepository;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    private Flusher $flusher;
    private UserRepository $users;

    public function __construct(
        UserRepository $users,
        Flusher $flusher
    ) {
        $this->flusher = $flusher;
        $this->users = $users;
    }

    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByNewEmailToken($command->token)) {
            throw new DomainException('Incorrect token');
        }

        $user->confirmEmailChanging(
            $command->token,
            new DateTimeImmutable()
        );

        $this->flusher->flush();
    }
}
