<?php

class RolesCreateViewTest extends \TestCase
{
    /** @test */
    public function it_returns_403_for_user_without_roles()
    {
        $this->prepare();

        $response = $this->actingAs($this->unauthorizedUser)
            ->call('GET', 'genealabs/laravel-governor/roles/create');

        $this->assertEquals(403, $response->getStatusCode());
    }

    /** @test */
    public function it_shows_rules_page_for_user_with_superadmin_role()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/roles/create')
            ->see('Roles');
    }

    /** @test */
    public function it_submits_new_role_for_user_with_superadmin_role()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/roles/create')
            ->type('Test Users', 'name')
            ->type('This is a description for test users role.', 'description')
            ->press('Add Role')
            ->see('Test Users');
    }
}
