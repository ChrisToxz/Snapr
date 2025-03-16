<?php

use App\Livewire\Upload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can upload snap', function () {
    Storage::fake('snaps');

    $user = createUser();
    $this->actingAs($user);

    $file = UploadedFile::fake()->image('test.png');

    Livewire::actingAs($user)->test(Upload::class)
        ->set('file', $file)
        ->call('save');

    Storage::disk('snaps')->assertExists($file->hashName());

    $this->assertDatabaseHas('snaps', [
        'user_id' => $user->id,
        'path' => $file->hashName(),
        'title' => 'test.png',
    ]);
});

it('validates file upload', function () {
    $file = UploadedFile::fake()->create('test.txt');

    Livewire::test(Upload::class)
        ->set('file', $file)
        ->call('save')
        ->assertHasErrors(['file']);
});
