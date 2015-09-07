<?php

use GeneaLabs\LaravelGovernor\Role;
use Illuminate\Support\Facades\Session;

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
}
