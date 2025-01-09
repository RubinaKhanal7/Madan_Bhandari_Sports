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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            // Permanent Address
            $table->string('p_province');
            $table->string('p_district');
            $table->string('p_local');
            $table->string('p_ward');
            $table->string('p_tole');
            
            // Temporary Address
            $table->string('t_province');
            $table->string('t_district');
            $table->string('t_local');
            $table->string('t_ward');
            $table->string('t_tole');
            
            $table->date('dob');
            $table->string('citizenship_no');
            $table->string('blood_group')->nullable();
            $table->string('father_name');
            $table->string('mother_name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->foreignId('member_type_id')->constrained('member_types');
            $table->string('profession')->nullable();
            $table->date('game_entry_date')->nullable();
            $table->date('membership_date')->nullable();
            $table->text('description')->nullable();
            $table->string('reference_no');
            $table->string('reference_name')->nullable();
            $table->string('p_image'); 
            $table->string('position')->nullable();
            $table->string('signature'); 
            
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
        Schema::dropIfExists('memberships');
    }
};