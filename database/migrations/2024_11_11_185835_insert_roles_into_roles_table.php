<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('roles')->insert([
            ['name' => 'buyer'],
            ['name' => 'manager'],
            ['name' => 'owner'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
