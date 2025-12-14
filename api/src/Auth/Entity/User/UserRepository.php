<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

use DomainException;

interface UserRepository
{
    public function hasByEmail(Email $email): bool;
    public function hasByNetwork(NetworkIdentity $identity): bool;

    public function findByConfirmToken(string $token): ?User;
    public function findByNewEmailToken(string $token): ?User;
    public function findByPasswordResetToken(string $token): ?User;
    /**
     * @throws DomainException
     */
    public function get(Id $id): User;
    public function add(User $user): void;
    /**
     * @throws DomainException
     */
    public function getByEmail(Email $email): User;

    public function remove(User $user);
}
