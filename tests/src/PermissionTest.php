<?php

use GeneaLabs\LaravelGovernor\Permission;

class PermissionTest extends TestCase
{
    /** @test */
    public function it_gets_actions()
    {
        $this->prepare();

        $permission = Permission::with('action')
            ->where('action_key', 'create')
            ->where('entity_key', 'role')
            ->where('role_key', 'SuperAdmin')
            ->first();

        $this->assertEquals('create', $permission->action->name);
    }

    /** @test */
    public function it_gets_entity()
    {
        $this->prepare();

        $permission = Permission::with('entity')
            ->where('action_key', 'create')
            ->where('entity_key', 'role')
            ->where('role_key', 'SuperAdmin')
            ->first();

        $this->assertEquals('role', $permission->entity->name);
    }

    /** @test */
    public function it_gets_ownership()
    {
        $this->prepare();

        $permission = Permission::with('ownership')
            ->where('action_key', 'create')
            ->where('entity_key', 'role')
            ->where('role_key', 'SuperAdmin')
            ->first();

        $this->assertEquals('any', $permission->ownership->name);
    }

    /** @test */
    public function it_gets_role()
    {
        $this->prepare();

        $permission = Permission::with('role')
            ->where('action_key', 'create')
            ->where('entity_key', 'role')
            ->where('role_key', 'SuperAdmin')
            ->first();

        $this->assertEquals('SuperAdmin', $permission->role->name);
    }
}
