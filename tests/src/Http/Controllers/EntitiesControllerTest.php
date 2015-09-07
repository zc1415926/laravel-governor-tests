<?php

use Illuminate\Support\Facades\Session;

class EntitiesControllerTest extends TestCase
{
    /** @test */
    public function it_shows_index_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/entities/')
            ->see('Entities')
            ->see('assignment')
            ->see('entity')
            ->see('permission')
            ->see('role');
    }

    /** @test */
    public function it_shows_create_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/entities/create')
            ->see('Add Entity')
            ->see('Name')
            ->see('Cancel');
    }

    /** @test */
    public function it_shows_edit_page()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->get('genealabs/laravel-governor/entities/assignment/edit')
            ->see('Edit Entity')
            ->see('Entity')
            ->see('Cancel')
            ->see('Update Entity')
            ->see('Delete Entity');
    }

    /** @test */
    public function it_adds_an_entity()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->post('genealabs/laravel-governor/entities', [
                '_token' => csrf_token(),
                'name' => 'testentity',
            ]);

        $this->seeInDatabase('entities', ['name' => 'testentity']);
    }

    /** @test */
    public function it_updates_an_entity()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->patch('genealabs/laravel-governor/entities/assignment', [
                '_token' => csrf_token(),
                'name' => 'testentity',
            ]);

        $this->seeInDatabase('entities', ['name' => 'testentity']);
        $this->notSeeInDatabase('entities', ['name' => 'assignment']);
    }

    /** @test */
    public function it_deletes_an_entity()
    {
        $this->prepare();

        $this->actingAs($this->superAdminUser)
            ->delete('genealabs/laravel-governor/entities/assignment', [
                '_token' => csrf_token(),
            ]);

        $this->notSeeInDatabase('entities', ['name' => 'assignment']);
    }
}
