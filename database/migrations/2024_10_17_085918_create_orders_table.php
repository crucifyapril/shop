<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement(); // Уникальный идентификатор
            $table->decimal('amount', 9, 2); // Сумма
            $table->string('status'); // Статус
            $table->text('description')->nullable(); // Описание
            $table->timestamps(); // Дата создания и дата последнего изменения
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
