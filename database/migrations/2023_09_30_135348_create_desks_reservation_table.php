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
        Schema::create('desks_reservation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desk_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('fio');
            $table->boolean('status');
            $table->unsignedTinyInteger('hours');
            $table->date('date_reserve');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('desk_id')->on('desks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desks_reservation');
    }
};
