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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->longText('title_ne');
            $table->longText('title_en');
            $table->longText('slogan_ne')->nullable();
            $table->longText('slogan_en')->nullable();
            $table->string('main_logo');
            $table->string('alt_logo')->nullable();
            $table->json('phone_no'); 
            $table->json('email'); 
            $table->string('established_year')->nullable();
            $table->longText('description_ne')->nullable();
            $table->longText('description_en')->nullable();
            $table->foreignId('socialmedia')->constrained('socialmedia')->onDelete('cascade'); 
            $table->text('google_map');
            $table->boolean('is_active')->default(true); 
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
        Schema::dropIfExists('site_settings');
    }
};
