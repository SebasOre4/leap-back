<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 100);
            $table->string('prediagnosis', 250)->default('n/a');
            $table->string('nhc', 25);
            $table->string('nickname', 25);
            $table->string('state', 25)->default('Internado');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('birthday');
            $table->date('crono_birthday')->nullable();
            $table->string('genre', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
