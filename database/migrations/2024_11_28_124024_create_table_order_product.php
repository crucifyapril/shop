<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_product_id_foreign');
            $table->dropColumn('product_id');
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            Schema::dropIfExists('order_product');

            Schema::table('orders', function (Blueprint $table) {
                $table->foreignId('product_id')->constrained('products');
            });
        });
    }
};
