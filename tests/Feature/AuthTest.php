<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has login page')
    ->get('/login')
    ->assertStatus(200)
    ->assertSee('Username')
    ->assertSee('Password');

it('redirects gueset to login page', function () {})->todo();

it('can login', function () {
    $user = createUser();
    $response = $this->post('/login', [
        'username' => $user->username,
        'password' => 'password',
    ]);

    $response->assertStatus(302);
    $this->assertAuthenticated();
});

it('does not login with wrong credentials', function () {
    $user = createUser();
    $response = $this->post('/login', [
        'username' => $user->username,
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(302)
        ->assertSessionHasErrors('username');
});

it('can logout', function () {
    $user = createUser();
    $this->actingAs($user);

    $this->assertAuthenticated();

    $this->delete('/logout')->assertRedirect();

    $this->assertGuest();
});
