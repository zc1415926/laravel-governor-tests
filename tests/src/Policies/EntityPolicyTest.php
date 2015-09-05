<?php

class EntityPolicyTest extends TestCase
{
    /** @test */
    public function it_cannot_create_an_entity_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->create($this->unauthorizedUser, $this->entity));
    }

    /** @test */
    public function it_cannot_create_an_entity_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->create($this->memberUser, $this->entity));
    }

    /** @test */
    public function it_can_create_an_entity_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->entityPolicy->create($this->superAdminUser, $this->entity));
    }

    /** @test */
    public function it_cannot_edit_an_entity_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->edit($this->unauthorizedUser, $this->entity));
    }

    /** @test */
    public function it_cannot_edit_an_entity_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->edit($this->memberUser, $this->entity));
    }

    /** @test */
    public function it_can_edit_an_entity_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->entityPolicy->edit($this->superAdminUser, $this->entity));
    }

    /** @test */
    public function it_cannot_view_an_entity_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->view($this->unauthorizedUser, $this->entity));
    }

    /** @test */
    public function it_cannot_view_an_entity_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->view($this->memberUser, $this->entity));
    }

    /** @test */
    public function it_can_view_an_entity_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->entityPolicy->view($this->superAdminUser, $this->entity));
    }

    /** @test */
    public function it_cannot_inspect_an_entity_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->inspect($this->unauthorizedUser, $this->entity));
    }

    /** @test */
    public function it_cannot_inspect_an_entity_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->inspect($this->memberUser, $this->entity));
    }

    /** @test */
    public function it_can_inspect_an_entity_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->entityPolicy->inspect($this->superAdminUser, $this->entity));
    }

    /** @test */
    public function it_cannot_remove_an_entity_for_unauthorized_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->remove($this->unauthorizedUser, $this->entity));
    }

    /** @test */
    public function it_remove_inspect_an_entity_for_member_user()
    {
        $this->prepare();

        $this->assertFalse($this->entityPolicy->remove($this->memberUser, $this->entity));
    }

    /** @test */
    public function it_can_remove_an_entity_for_superadmin_user()
    {
        $this->prepare();

        $this->assertTrue($this->entityPolicy->remove($this->superAdminUser, $this->entity));
    }
}
