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
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->notNull();
            $table->string('mname')->nullable();
            $table->string('lname')->notNull();
            $table->date('bdate')->notNull();
            $table->string('bplace')->notNull();
            $table->string('address')->notNull();
            $table->unsignedTinyInteger('sex')->notNull();
            $table->unsignedTinyInteger('civil_status')->notNull();
            $table->unsignedInteger('id_type')->notNull();
            $table->longText('id_dir')->notNull();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};
