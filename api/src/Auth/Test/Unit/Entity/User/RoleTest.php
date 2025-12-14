<?php

declare(strict_types=1);

namespace App\Auth\Test\Unit\Entity\User;

use App\Auth\Entity\User\Role;
use PHPUnit\Framework\TestCase;

/**
 * covers Role
 */
class RoleTest extends TestCase
{
    public function testUser(): void
    {
        $role = Role::user();
        $this->assertEquals(Role::USER, $role->getName());

        $role = new Role(Role::USER);
        $this->assertEquals(Role::USER, $role->getName());
    }

    public function testAdmin(): void
    {
        $role = new Role(Role::ADMIN);
        $this->assertEquals(Role::ADMIN, $role->getName());
    }
}
