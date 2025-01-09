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
        Schema::create('membership_verifiers', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('membership_id')->constrained('memberships') ->onDelete('cascade');
            $table->foreignId('verifier_id')->constrained('verifiers')->onDelete('cascade');
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
        Schema::dropIfExists('membership_verifiers');
    }
};
