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
        Schema::table('players', function (Blueprint $table) {
            // Добавляем дату смены роли после clan_role
            $table->date('role_changed_at')->nullable()->after('clan_role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('role_changed_at');
        });
    }
};
