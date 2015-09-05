<?php

class AssignmentsViewTest extends TestCase
{
    protected $superAdminUser;
    protected $unauthorizedUser;

    public function prepare()
    {
        $this->artisan('migrate', ['--path' => 'packages/genealabs/laravel-governor/database/migrations']);
        $this->superAdminUser = factory(LaravelGovernorTests\User::class)->create();
        $this->artisan('db:seed', ['--class' => 'LaravelGovernorDatabaseSeeder']);
        $this->unauthorizedUser = factory(LaravelGovernorTests\User::class)->create();
        $this->superAdminUser->fill([
            'name' => 'Test User',
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'testuser@noemail.com',
            'password' => 'test123$',
        ]);
        $this->superAdminUser->save();
    }

    /**
     * @test
     */
    public function it_returns_403_for_user_without_roles()
    {
        $this->prepare();

        $response = $this->actingAs($this->unauthorizedUser)
            ->call('GET', 'genealabs/laravel-governor/assignments');

        $this->assertEquals(403, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function it_shows_rules_page_for_user_with_superadmin_role()
    {
        $this->prepare();

        $response = $this->actingAs($this->superAdminUser)
            ->visit('genealabs/laravel-governor/assignments')
            ->see('Roles');
    }
}
