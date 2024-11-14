<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->after('status')->comment('Имя покупателя');
            $table->string('phone')->after('name')->comment('Телефон покупателя');
            $table->text('comment')->nullable()->after('phone')->comment('Комментарий покупателя');
            $table->foreignId('product_id')->after('status')->nullable(false)->constrained('products');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'comment', 'product_id']);
        });
    }
};
