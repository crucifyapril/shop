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
            $table->id()->primary()->autoIncrement()->comment('Уникальный идентификатор');
            $table->string('name')->comment('Наименование');
            $table->integer('price')->comment('Цена');
            $table->text('description')->nullable()->comment('Описание');
            $table->integer('quantity')->default(0)->comment('Количество');
            $table->boolean('available_for_sale')->nullable(false)->comment('Доступен ли к продаже');
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
