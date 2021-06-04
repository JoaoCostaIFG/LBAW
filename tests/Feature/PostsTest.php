<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PostsTest extends TestCase
{
    public function testAddComment()
    {
        $response = $this->actingAs(User::find(1))->post('/ajax/comment', ['answer_id' => 10, 'body' => 'asdasd']);
        $response->dump();
        $response->assertStatus(200);
    }

    public function testAskQuestion()
    {
        $response = $this->actingAs(User::find(1))->post('/user/ask', ['title' => 'aaaaa', 'bounty' => 0, 'body' => 'xxxxxasdasd', 'topics' => [[]]]);
        $response->assertStatus(405);
    }

    public function testAddBounty()
    {
        $response = $this->actingAs(User::find(9))->post('/question/18/addBounty', ['bounty' => 5]);
        $response->assertStatus(302);
    }

}
