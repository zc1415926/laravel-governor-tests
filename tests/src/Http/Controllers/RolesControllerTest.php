<?php

use GeneaLabs\LaravelGovernor\Role;
use Illuminate\Support\Facades\Session;

class RolesControllerTest extends TestCase
{
    /** @test */
    public function it_edits_role_for_user_with_superadmin_role()
    {
        $this->prepare();

        $response = $this->actingAs($this->superAdminUser)
            ->patch('genealabs/laravel-governor/roles/Member', [
                '_token' => csrf_token(),
                'name' => 'Member',
                'description' => 'Role for testing.',
                'permissions' => [
                    'role' => [
                        "create" => "no",
                        "view" => "any",
                        "inspect" => "no",
                        "edit" => "no",
                        "remove" => "no",
                    ],
                    'entity' => [
                        "create" => "no",
                        "view" => "no",
                        "inspect" => "no",
                        "edit" => "no",
                        "remove" => "no",
                    ],
                    'permission' => [
                        "create" => "no",
                        "view" => "no",
                        "inspect" => "no",
                        "edit" => "no",
                        "remove" => "no",
                    ],
                    'assignment' => [
                        "create" => "no",
                        "view" => "no",
                        "inspect" => "no",
                        "edit" => "no",
                        "remove" => "no",
                    ],
                ],
            ]);
        $role = Role::with('permissions')->find('Member');

        $this->assertTrue($this->memberUser->can('view', $role));
    }

    /** @test */
    public function it_can_delete_a_role_as_a_superadmin_user()
    {
        $this->prepare();

        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/roles/create')
            ->type('TestRole', 'name')
            ->type('This is a description for test users role.', 'description')
            ->press('Add Role')
            ->see('TestRole')
            ->onPage('genealabs/laravel-governor/roles');

        $response = $this->actingAs($this->superAdminUser)
            ->delete('genealabs/laravel-governor/roles/TestRole', [
                '_token' => csrf_token(),
            ]);


        $this->assertCount(0, Role::where('name', 'TestRole')->get());
    }
}
