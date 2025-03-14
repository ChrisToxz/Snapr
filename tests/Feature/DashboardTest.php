<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('guest', function () {
    test('cannot access dashboard', function () {
        $this->get('/dashboard')
            ->assertRedirect(route('login'));
    });
});

describe('auth', function () {
    beforeEach(function () {
        actingAs($this->user = createUser());
    });

    it('has dashboard page', function () {
        $this->get('/dashboard')
            ->assertStatus(200);
    });

    it('shows message when no images are uploaded yet', function () {
        $this->get('/dashboard')
            ->assertSeeText('No images found.');
    });

    it('renders menu', function () {
        $this->get('/dashboard')
            ->assertSeeText(['Home', 'Upload', $this->user->username]);
    });

});
