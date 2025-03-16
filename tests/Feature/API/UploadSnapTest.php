<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);
it('has an upload API endpoint', function () {
    $response = $this->get('/api/v1/upload');
    $response->assertValid();
});

it('requires have a valid token to upload a snap')->defer(function () {
    $response = $this->postJson('/api/v1/upload', [
        'image' => UploadedFile::fake()->image('test.png'),
    ]);

    $response->assertStatus(401);
});

it('can upload a snap through API when authenticated', function () {

    $user = createUser();
    $this->actingAs($user);

    $response = $this->postJson('/api/v1/upload', [
        'image' => UploadedFile::fake()->image('test.png'),
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'ident',
            'url',
        ]);

    $this->assertDatabaseHas('snaps', [
        'user_id' => $user->id,
        'title' => 'test.png',
    ]);
});
