<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favicons', function (Blueprint $table) {
            $table->id();
            $table->string('fav_16')->nullable();
            $table->string('fav_32')->nullable();
            $table->string('fav_ico')->nullable();
            $table->string('fav_apple')->nullable();
            $table->string('fav_192')->nullable();
            $table->string('fav_512')->nullable();
            $table->string('site_manifest')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favicons');
    }
};
