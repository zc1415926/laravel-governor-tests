<?php

use GeneaLabs\LaravelGovernor\Role;

class RolesEditViewTest extends TestCase
{
    /** @test */
    public function it_returns_403_for_user_without_roles()
    {
        $this->prepare();

        $response = $this->actingAs($this->unauthorizedUser)
            ->call('GET', 'genealabs/laravel-governor/roles/Member/edit');

        $this->assertEquals(403, $response->getStatusCode());
    }

    /** @test */
    public function it_shows_rules_page_for_user_with_superadmin_role()
    {
        $this->prepare();

        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/roles/Member/edit')
            ->see('Roles');
    }

    /** @test */
//    public function it_edits_role_for_user_with_superadmin_role()
//    {
//        $this->prepare();
//
//        $response = $this->actingAs($this->superAdminUser)
//            ->visit('genealabs/laravel-governor/roles/Member/edit')
//            ->click('selected-entity-create')
//            ->click('create any')
//            ->press('Update Role');
//
//        dd($response);
//    }

    /** @test */
//    public function it_can_delete_a_role_as_a_superadmin_user()
//    {
//        $this->prepare();
//
//        $response = $this->actingAs($this->superAdminUser)
//            ->visit('genealabs/laravel-governor/roles/create')
//            ->type('TestRole', 'name')
//            ->type('This is a description for test users role.', 'description')
//            ->press('Add Role')
//            ->see('TestRole')
//            ->onPage('genealabs/laravel-governor/roles');
//
//        $response = $this->actingAs($this->superAdminUser)
//            ->visit('genealabs/laravel-governor/roles/TestRole/edit')
//            ->press('Delete Role');
//    }
}
