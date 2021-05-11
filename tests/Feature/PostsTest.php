<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PostsTest extends TestCase
{
    public function testAddComment()
    {
        $response = $this->actingAs(User::find(1))->post('/ajax/comment', ['answer_id' => 3, 'body' => 'asdasd']);
        $response->assertStatus(200);
    }

    public function testAskQuestion()
    {
        $response = $this->actingAs(User::find(1))->post('/user/ask', ['title' => 'aaaaa', 'bounty' => 0, 'body' => 'xxxxxasdasd', 'topics' => [[]]]);
        $response->assertStatus(405);
    }
}
