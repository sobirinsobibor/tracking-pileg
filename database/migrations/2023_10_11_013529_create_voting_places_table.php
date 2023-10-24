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
        Schema::create('voting_places', function (Blueprint $table) {
            $table->id();
            $table->char('voting_place_artificial_id', 7)->unique()->nullable(false);
            $table->char('voting_place_encrypted_id', 16)->unique()->nullable(false);
            $table->string('voting_place_name', 50)->nullable(false);
            $table->string('voting_place_address', 100)->nullable(false);
            $table->string('voting_place_city', 50)->nullable(false);
            $table->string('voting_place_province', 50)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_places');
    }
};
