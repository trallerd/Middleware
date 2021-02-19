<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProfessorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('POST', 'http://127.0.0.1:8000/api/professor',['nome'=>'Professor 1','email'=>'professor1@gmail.com']);

        $response
            ->assertStatus(200);
    }
}
