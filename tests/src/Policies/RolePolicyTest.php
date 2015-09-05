<?php

class RolePolicyTest extends TestCase
{
    /** @test */
    public function it_cannot_create_a_role_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->create($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_cannot_create_a_role_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->create($this->memberUser, $this->role));
    }

    /** @test */
    public function it_can_create_a_role_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->rolePolicy->create($this->superAdminUser, $this->role));
    }

    /** @test */
    public function it_cannot_edit_a_role_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->edit($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_cannot_edit_a_role_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->edit($this->memberUser, $this->role));
    }

    /** @test */
    public function it_can_edit_a_role_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->rolePolicy->edit($this->superAdminUser, $this->role));
    }

    /** @test */
    public function it_cannot_view_a_role_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->view($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_cannot_view_a_role_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->view($this->memberUser, $this->role));
    }

    /** @test */
    public function it_can_view_a_role_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->rolePolicy->view($this->superAdminUser, $this->role));
    }

    /** @test */
    public function it_cannot_inspect_a_role_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->inspect($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_cannot_inspect_a_role_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->inspect($this->memberUser, $this->role));
    }

    /** @test */
    public function it_can_inspect_a_role_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->rolePolicy->inspect($this->superAdminUser, $this->role));
    }

    /** @test */
    public function it_cannot_remove_a_role_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->remove($this->unauthorizedUser, $this->role));
    }

    /** @test */
    public function it_remove_inspect_a_role_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->rolePolicy->remove($this->memberUser, $this->role));
    }

    /** @test */
    public function it_can_remove_a_role_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->rolePolicy->remove($this->superAdminUser, $this->role));
    }
}
