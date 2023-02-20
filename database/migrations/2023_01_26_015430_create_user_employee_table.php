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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('name');
            $table->decimal('salary');
            $table->tinyInteger('per_hour')->default(0);
            $table->tinyInteger('teacher')->default(0);
            $table->date('birth_date')->nullable();
            $table->string('sex')->nullable();
            $table->string('cpf')->unique();
            $table->string('rg')->nullable();
            $table->string('ctps_number')->nullable();
            $table->string('ctps_serie')->nullable();
            $table->foreignId('occupation_id')->constrained('occupations');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('school_id')->constrained('schools');
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
};
