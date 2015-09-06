<?php

use GeneaLabs\LaravelGovernor\Ownership;

class OwnershipTest extends TestCase
{
    /** @test */
    public function it_gets_permissions()
    {
        $this->prepare();

        $ownership = Ownership::with('permissions')->find('any');
        $this->assertGreaterThan(19, $ownership->permissions->count());
    }
}
