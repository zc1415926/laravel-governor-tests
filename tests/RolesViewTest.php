<?php

class RolesViewTest extends TestCase
{
    protected $user;

    public function prepare()
    {
        $this->artisan('migrate', ['--path' => 'packages/genealabs/laravel-governor/database/migrations']);
        $this->user = factory(LaravelGovernorTests\User::class)->create();
        $this->artisan('db:seed', ['--class' => 'LaravelGovernorDatabaseSeeder']);
    }

    /**
     * @test
     */
    public function it_returns_403_for_user_without_roles()
    {
        $this->prepare();
        $response = $this->actingAs($this->user)
            ->call('GET', 'genealabs/laravel-governor/roles');

        $this->assertEquals(403, $response->getStatusCode());
    }
}
