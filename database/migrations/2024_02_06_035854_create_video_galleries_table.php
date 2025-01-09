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
        Schema::create('video_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title_ne'); 
            $table->string('title_en'); 
            $table->string('videos')->nullable();
            $table->string('url'); 
            $table->text('description_ne')->nullable(); 
            $table->text('description_en')->nullable(); 
            $table->boolean('is_featured')->default(false); 
            $table->boolean('is_active')->default(true); 
            $table->foreignId('meta_data_id')->nullable()->constrained('meta_data')->onDelete('set null');
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
        Schema::dropIfExists('video_galleries');
    }
};