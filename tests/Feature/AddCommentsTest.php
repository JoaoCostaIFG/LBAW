<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AddCommentsTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->actingAs(User::find(1))->post('/ajax/comment', ['answer_id' => 3, 'body' => 'asdasd']);

        $response->dump();
        $response->assertStatus(200);
    }
}
