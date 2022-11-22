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
        Schema::connection('template')->create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('availability')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('added_by')->constrained('regcalls_root.users');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('stocks');
    }
};
