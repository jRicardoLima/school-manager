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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('name');
            $table->date('birth_date');
            $table->string('sex')->nullable();
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->string('responsible_name')->nullable();
            $table->string('responsible_cpf')->nullable();
            $table->string('kinsman')->nullable();
            $table->string('has_disease');
            $table->string('which_disease');
            $table->foreignId('school_id')->constrained('schools');
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
        Schema::dropIfExists('students');
    }
};
