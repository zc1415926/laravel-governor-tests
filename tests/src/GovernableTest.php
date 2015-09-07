<?php

class GovernableTest extends TestCase
{
    /** @test */
    public function it_has_roles()
    {
        $this->prepare();

        $this->assertTrue($this->superAdminUser->roles->contains('SuperAdmin'));
    }

    /** @test */
    public function it_returns_superadmin_attribute()
    {
        $this->prepare();

        $this->assertTrue($this->superAdminUser->isSuperAdmin);
        $this->assertFalse($this->memberUser->isSuperAdmin);
    }
}
