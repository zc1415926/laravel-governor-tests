<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesViewTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $user;

    public function setup()
    {
        parent::setup();

        $this->artisan('migrate', ['--path' => 'vendor/genealabs/laravel-governor/database/migrations']);
    }

    /**
     * @test
     */
    public function it_returns_403_for_user_without_roles()
    {
        $this->user = factory(LaravelGovernorTests\User::class)->create();
        $this->artisan('db:seed', ['--class' => 'LaravelGovernorDatabaseSeeder']);

        $response = $this->actingAs($this->user)
            ->call('GET', 'genealabs/laravel-governor/roles');

        $this->assertEquals(403, $response->getStatusCode());
    }
}
