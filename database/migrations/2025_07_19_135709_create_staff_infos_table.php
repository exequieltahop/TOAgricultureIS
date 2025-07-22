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
        Schema::create('staff_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('f_name')->notNull();
            $table->string('m_name')->nullable();
            $table->string('l_name')->notNull();
            $table->dateTime('b_date')->notNull();
            $table->string('b_place')->notNull();
            $table->unsignedInteger('sex')->notNull();
            $table->unsignedInteger('civil_status')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_infos');
    }
};
