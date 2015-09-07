<?php

use GeneaLabs\LaravelGovernor\Http\Requests\UpdateEntityRequest;

class UpdateEntityRequestTest extends TestCase
{
    /** @test */
    public function it_is_authorized()
    {
        $this->prepare();

        $request = new UpdateEntityRequest();
        $this->be($this->superAdminUser);

        $this->assertTrue($request->authorize());
        $this->be($this->unauthorizedUser);
        $this->assertFalse($request->authorize());
    }

    /** @test */
    public function it_has_the_right_rules()
    {
        $this->prepare();

        $request = new UpdateEntityRequest();

        $this->assertTrue(array_key_exists('name', $request->rules()));
        $this->assertEquals('required', $request->rules()['name']);
    }
}
