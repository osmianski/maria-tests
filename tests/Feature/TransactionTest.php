<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

uses(DatabaseMigrations::class);

it('supports nested transactions', function () {
    $this->expectException(RuntimeException::class);

    DB::transaction(function () {
        DB::transaction(function () {
            DB::transaction(function () {
                throw new RuntimeException();
            });
        });
    });
});
