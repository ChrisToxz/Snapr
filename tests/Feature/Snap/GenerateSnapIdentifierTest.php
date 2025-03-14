<?php

use App\Actions\Snap\GenerateSnapIdentifier;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates an unique identifier with default parameters', function () {
    $ident = GenerateSnapIdentifier::run();
    expect($ident)->toBeString()->toHaveLength(8);
});

it('generates an unique identifier with custom length', function () {
    $ident = GenerateSnapIdentifier::run(10);
    expect($ident)->toBeString()->toHaveLength(10);
});

it('makes sure the identifier is unique', function () {
    // ? Sketchy though.
    $ident = GenerateSnapIdentifier::run();
    expect(GenerateSnapIdentifier::run())->not()->toBe($ident);
});
