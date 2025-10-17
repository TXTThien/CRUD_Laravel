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
        Schema::create('player_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('player_uuid');
            $table->string('action');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('player_uuid')
                ->references('uuid')
                ->on('players')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
