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
        Schema::table('wallets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('coin_id')->references('id')->on('coins')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::table('miners', function (Blueprint $table) {
            $table->foreign('wallet_id')->references('id')->on('wallets')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('algo_id')->references('id')->on('algos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('coin_id');
        });
        Schema::table('miners', function (Blueprint $table) {
            $table->dropConstrainedForeignId('wallet_id');
            $table->dropConstrainedForeignId('job_id');
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('algo_id');
        });
    }
};
