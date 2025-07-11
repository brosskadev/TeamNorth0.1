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
        $table->id(); // автоинкрементный PK, называется id
        $table->integer('player_id')->unique(); // уникальный вводимый вручную

        $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade'); 
        // уникальный, чтобы 1:1 связь User-Player

        // Остальные поля
        $table->string('steam_id')->nullable();
        $table->string('specialization')->nullable();
        $table->string('brigade')->nullable();
        $table->date('join_date')->nullable();
        $table->integer('days_in_team')->default(0);
        $table->integer('days_recruit')->nullable();
        $table->integer('days_prospect')->nullable();
        $table->integer('days_main')->nullable();
        $table->integer('kills')->default(0);
        $table->integer('deaths')->default(0);
        $table->boolean('on_holiday')->default(false);
        $table->string('clan_role')->nullable();
        $table->dateTime('kick_date')->nullable();

        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
