<?php

use Illuminate\Support\Facades\Session;

class AssignmentsControllerTest extends TestCase
{
    /** @test */
    public function it_shows_index_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/assignments/')
            ->see('SuperAdmin')
            ->see('Members');
    }

    /** @test */
    public function it_stores_assignments()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->post('genealabs/laravel-governor/assignments', [
                '_token' => csrf_token(),
                'users' => [
                    'SuperAdmin' => [
                        1,
                        $this->memberUser->id,
                    ],
                ],
            ]);

        $this->memberUser->load('roles');
        $this->assertTrue($this->memberUser->roles->contains('SuperAdmin'));
    }
}
