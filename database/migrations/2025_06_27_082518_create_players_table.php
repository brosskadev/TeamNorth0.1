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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('join_date')->nullable();
            $table->integer('days_in_team')->default(0);
            $table->integer('kills')->default(0);
            $table->integer('deaths')->default(0);
            $table->boolean('online')->default(false);
            $table->string('clan_role')->nullable();
            $table->dateTime('kick_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
