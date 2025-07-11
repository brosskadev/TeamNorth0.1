<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('players', function (Blueprint $table) {
        $table->date('recruit_started_at')->nullable();
        $table->date('prospect_started_at')->nullable();
        $table->date('main_started_at')->nullable();
    });
}

public function down()
{
    Schema::table('players', function (Blueprint $table) {
        $table->dropColumn(['recruit_started_at', 'prospect_started_at', 'main_started_at']);
    });
}
};
