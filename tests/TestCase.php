<?php

use GeneaLabs\LaravelGovernor\Policies\RolePolicy;
use GeneaLabs\LaravelGovernor\Role;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LaravelGovernorTests\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';
    protected $superAdminUser;
    protected $memberUser;
    protected $unauthorizedUser;
    protected $role;
    protected $rolePolicy;
    protected $superAdminRole;
    protected $memberRole;


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        ini_set('xdebug.max_nesting_level', -1);
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

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

        $this->rolePolicy = new RolePolicy();
        $this->superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $this->memberRole = Role::where('name', 'Member')->first();
        $this->role = new Role();

        $this->memberUser = User::limit(2)->get()->last();
        $this->memberUser->roles()->save($this->memberRole);
        $this->memberUser->save();
    }
}
