<?php

use GeneaLabs\LaravelGovernor\Role;
use Illuminate\Support\Facades\Session;

class RolesControllerTest extends TestCase
{
    /** @test */
    public function it_shows_index_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/roles/')
            ->see('Roles')
            ->see('Member')
            ->see('SuperAdmin')
            ->see('Add New Role');
    }

    /** @test */
    public function it_shows_create_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/roles/create')
            ->see('Add Role')
            ->see('Name')
            ->see('Message')
            ->see('Cancel')
            ->see('Add Role');
    }

    /** @test */
    public function it_shows_edit_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/roles/Member/edit')
            ->see('Edit Role')
            ->see('Name')
            ->see('Description')
            ->see('Member')
            ->see('Cancel')
            ->see('Update Role');
    }

    /** @test */
    public function it_adds_an_role()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->post('genealabs/laravel-governor/roles', [
                '_token' => csrf_token(),
                'name' => 'TestRole',
                'description' => 'This is a description for test users role.',
            ]);

        $this->seeInDatabase('roles', [
            'name' => 'TestRole',
            'description' => 'This is a description for test users role.',
        ]);
    }

    /** @test */
    public function it_updates_a_role()
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
    public function it_deletes_an_role()
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
