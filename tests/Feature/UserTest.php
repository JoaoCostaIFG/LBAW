<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testGetBasicLoggedProfile()
    {
        $response = $this->actingAs(User::find(1))->get('/api/user');
        $response->assertStatus(200);
    }

    public function testBanUser() {
        $response = $this->actingAs(User::find(2))->post('/users/1/ban');
        $response->assertStatus(302);
    }
}

