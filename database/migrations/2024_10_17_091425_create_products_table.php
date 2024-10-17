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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement(); // Уникальный идентификатор
            $table->string('name'); // Наименование
            $table->decimal('price', 9, 2); // Цена
            $table->text('description')->nullable(); // Описание
            $table->integer('quantity')->default(0); // Количество
            $table->boolean('available_for_sale')->nullable(false); // Доступен ли к продаже
            $table->timestamps(); // Дата создания и дата последнего изменения
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
