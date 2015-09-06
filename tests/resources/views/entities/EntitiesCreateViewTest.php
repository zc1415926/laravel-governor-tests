<?php

class EntitiesCreateViewTest extends TestCase
{
    /** @test */
    public function it_returns_403_for_user_without_roles()
    {
        $this->prepare();

        $response = $this->actingAs($this->unauthorizedUser)
            ->call('GET', 'genealabs/laravel-governor/entities/create');

        $this->assertEquals(403, $response->getStatusCode());
    }

    /** @test */
    public function it_shows_rules_page_for_user_with_superadmin_role()
    {
        $this->prepare();

        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/entities/create')
            ->see('Entities');
    }

    /** @test */
    public function it_submits_new_role_for_user_with_superadmin_role()
    {
        $this->prepare();

        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/entities/create')
            ->type('announcement', 'name')
            ->press('Add Entity')
            ->see('announcement')
            ->onPage('genealabs/laravel-governor/entities');
    }
}
