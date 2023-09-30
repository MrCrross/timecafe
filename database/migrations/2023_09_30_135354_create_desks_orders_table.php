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
        Schema::create('desks_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desk_id');
            $table->unsignedTinyInteger('status');
            $table->dateTime('date_order');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('desk_id')->on('desks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desks_orders');
    }
};
