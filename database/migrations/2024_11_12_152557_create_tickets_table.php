<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('location');
        $table->date('date');
        $table->time('time');
        $table->string('price_tribun');
        $table->integer('stock_tribun');
        $table->string('price_vip');
        $table->integer('stock_vip');
        $table->string('banner')->nullable();
        $table->string('team1_logo')->nullable();
        $table->string('team2_logo')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
