<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('template')->create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->float('real_price');
            $table->integer('quantity');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('stock_id')->constrained('stocks');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_items');
    }
};
