<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('statuses')->insert([
           ['name' => 'pending'],
           ['name' => 'succeeded'],
           ['name' => 'waiting_for_capture'],
           ['name' => 'canceled'],
           ['name' => 'error'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
