<?php

class AssigmentPolicyTest extends TestCase
{
    /** @test */
    public function it_cannot_create_an_assignment_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->create($this->unauthorizedUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_create_an_assignment_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->create($this->memberUser, $this->assignment));
    }

    /** @test */
    public function it_can_create_an_assignment_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->assignmentPolicy->create($this->superAdminUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_edit_an_assignment_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->edit($this->unauthorizedUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_edit_an_assignment_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->edit($this->memberUser, $this->assignment));
    }

    /** @test */
    public function it_can_edit_an_assignment_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->assignmentPolicy->edit($this->superAdminUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_view_an_assignment_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->view($this->unauthorizedUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_view_an_assignment_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->view($this->memberUser, $this->assignment));
    }

    /** @test */
    public function it_can_view_an_assignment_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->assignmentPolicy->view($this->superAdminUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_inspect_an_assignment_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->inspect($this->unauthorizedUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_inspect_an_assignment_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->inspect($this->memberUser, $this->assignment));
    }

    /** @test */
    public function it_can_inspect_an_assignment_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->assignmentPolicy->inspect($this->superAdminUser, $this->assignment));
    }

    /** @test */
    public function it_cannot_remove_an_assignment_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->remove($this->unauthorizedUser, $this->assignment));
    }

    /** @test */
    public function it_remove_inspect_an_assignment_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->assignmentPolicy->remove($this->memberUser, $this->assignment));
    }

    /** @test */
    public function it_can_remove_an_assignment_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->assignmentPolicy->remove($this->superAdminUser, $this->assignment));
    }
}
