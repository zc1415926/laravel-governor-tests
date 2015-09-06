<?php

class ConfigTest extends TestCase
{
    /** @test */
    public function it_has_correct_config_file_format()
    {
        $config = require(base_path('packages/genealabs/laravel-governor/config/config.php'));

        $this->assertTrue(array_key_exists('layoutView', $config));
        $this->assertTrue(array_key_exists('bladeContentSection', $config));
        $this->assertTrue(array_key_exists('displayNameField', $config));
        $this->assertEquals('genealabs-laravel-governor::layout', $config['layoutView']);
        $this->assertEquals('content', $config['bladeContentSection']);
        $this->assertEquals('name', $config['displayNameField']);
    }
}
