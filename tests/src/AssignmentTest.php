<?php

use GeneaLabs\LaravelGovernor\Assignment;
use GeneaLabs\LaravelGovernor\Role;
use LaravelGovernorTests\User;

class AssignmentTest extends TestCase
{
    protected $assignment;

    public function setUp()
    {
        parent::setUp();

        $this->assignment = new Assignment();
    }

    /** @test */
    public function it_adds_all_users_to_member_role()
    {
        $this->prepare();

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test.user@noemail.com',
            'password' => 'test1234',
        ]);

        $this->assignment->addAllUsersToMemberRole();
        $user->load('roles');

        $this->assertTrue($user->roles->contains('Member'));
    }

    /** @test */
    public function it_removes_superadmin_users_from_all_other_roles()
    {
        $this->prepare();
        $this->assignment->addAllUsersToMemberRole();
        $this->superAdminUser->load('roles');
        $this->assertTrue($this->superAdminUser->roles->contains('Member'));
        $this->assignment->removeAllSuperAdminUsersFromOtherRoles(['Member' => [1], 'SuperAdmin' => [1]]);
        $this->superAdminUser->load('roles');
        $this->assertFalse($this->superAdminUser->roles->contains('Member'));
    }

    /** @test */
    public function it_assigns_users_to_roles()
    {
        $this->prepare();
        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/roles/create')
            ->type('TestUsers', 'name')
            ->type('This is a description for test users role.', 'description')
            ->press('Add Role')
            ->see('TestUsers');
        $this->assignment->assignUsersToRoles(['TestUsers' => [$this->memberUser->id]]);
        $this->assertTrue($this->memberUser->roles->contains('TestUsers'));
    }

    /** @test */
    public function it_removes_all_users_from_roles()
    {
        $this->prepare();
        $this->superAdminUser->load('roles');
        $this->assertTrue($this->superAdminUser->roles->contains('SuperAdmin'));
        $this->assignment->removeAllUsersFromRoles();
        $this->superAdminUser->load('roles');
        $this->assertFalse($this->superAdminUser->roles->contains('SuperAdmin'));
    }

    /** @test */
    public function it_gets_all_users_belonging_to_a_role()
    {
        $this->prepare();
        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/roles/create')
            ->type('TestUsers', 'name')
            ->type('This is a description for test users role.', 'description')
            ->press('Add Role')
            ->see('TestUsers');
        $this->assignment->assignUsersToRoles(['TestUsers' => [$this->memberUser->id]]);
        $this->assertTrue($this->memberUser->roles->contains('TestUsers'));

        $users = $this->assignment->getAllUsersOfRole('TestUsers');
        $this->assertTrue($users->contains($this->memberUser->id));
    }
}
