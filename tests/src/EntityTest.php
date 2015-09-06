<?php

use GeneaLabs\LaravelGovernor\Entity;

class EntityTest extends TestCase
{
    /** @test */
    public function it_gets_permissions()
    {
        $this->prepare();

        $entity = Entity::with('permissions')->find('role');
        $this->assertGreaterThan(4, $entity->permissions->count());
    }
}
