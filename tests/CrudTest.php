<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(RefreshDatabase::class);
uses(DatabaseMigrations::class);

uses()->beforeEach(fn () =>dump(get_class($this)) );

it('table exists', function () {
    $check = Schema::hasTable('users');
    expect($check)->toBeTrue();qq
});

