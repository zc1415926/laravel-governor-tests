<?php

use GeneaLabs\LaravelGovernor\Action;

class ActionTest extends TestCase
{
    /** @test */
    public function it_gets_permissions()
    {
        $this->prepare();

        $action = Action::with('permissions')->find('create');
        $this->assertGreaterThan(3, $action->permissions->count());
    }
}
