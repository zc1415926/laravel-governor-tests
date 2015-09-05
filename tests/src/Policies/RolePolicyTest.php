<?php

use GeneaLabs\LaravelGovernor\Policies\RolePolicy;
use GeneaLabs\LaravelGovernor\Role;

class RolePolicyTest extends TestCase
{
    protected $rolePolicy;
    protected $superAdminRole;
    protected $memberRole;

    public function prepare()
    {
        parent::prepare();

        $this->rolePolicy = new RolePolicy();
        $this->superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $this->memberRole = Role::where('name', 'Member')->first();
        $this->role = new Role();
    }

    /** @test */
    public function it_cannot_create_a_role_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->create($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_cannot_create_a_role_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->create($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_can_create_a_role_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->rolePolicy->create($this->superAdminUser, $this->role));
    }
}
