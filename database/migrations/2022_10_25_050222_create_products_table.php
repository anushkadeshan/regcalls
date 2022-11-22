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
        Schema::connection('template')->create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000);
            $table->string('code',255);
            $table->string('short_title',255);
            $table->boolean('is_free')->default(false);
            $table->enum('type',['Physical','Digital']);
            $table->boolean('is_active')->default(true);
            $table->boolean('pre_login')->default(true);
            $table->float('price');
            $table->float('real_price');
            $table->integer('quantity');
            $table->string('main_image');
            $table->json('images')->nullable();
            $table->string('tech_specs')->nullable();
            $table->text('details')->nullable();
            $table->json('downloads')->nullable();
            $table->string('status')->nullable();
            $table->string('expiry_date')->nullable();
            $table->foreignId('stock_id')->constrained('stocks');
            $table->foreignId('added_by')->constrained('regcalls_root.users');
            $table->foreignId('approved_by')->nullable()->constrained('regcalls_root.users');
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
        Schema::dropIfExists('products');
    }
};
