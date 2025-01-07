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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->longText('title_ne');
            $table->longText('title_en');
            $table->longText('description_ne')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('image')->nullable();
            $table->json('other_images')->nullable();
            $table->json('pdf')->nullable(); 
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
};
