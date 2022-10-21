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
        Schema::create('databases', function (Blueprint $table) {
            $table->id();
            $table->string('connection');
            $table->string('driver')->default('mysql');
            $table->string('url')->default(null)->nullable();
            $table->string('host')->default('127.0.0.1');
            $table->integer('port')->default(3306);
            $table->string('database');
            $table->string('username')->default('');
            $table->string('password')->default('')->nullable();
            $table->string('unix_socket')->default('')->nullable();
            $table->string('charset')->default('utf8mb4');
            $table->string('collation')->default('utf8mb4_unicode_ci');
            $table->string('prefix')->default('')->nullable();
            $table->boolean('prefix_indexes')->default(true);
            $table->boolean('strict')->default(true);
            $table->string('engine')->default(null)->nullable();
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
        Schema::dropIfExists('databases');
    }
};
