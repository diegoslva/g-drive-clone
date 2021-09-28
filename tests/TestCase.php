<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function testCreated()
    {
        $response = $this->post('POST', 'api/users', [
            'name' => 'Sally',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

}
