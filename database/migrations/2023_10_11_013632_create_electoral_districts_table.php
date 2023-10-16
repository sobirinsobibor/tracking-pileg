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
        Schema::create('electoral_districts', function (Blueprint $table) {
            $table->id();
            $table->char('electoral_district_artificial_id', 3)->unique()->nullable(false);
            $table->char('electoral_district_encrypted_id', 16)->unique()->nullable(false);
            $table->string('electoral_district_name', 50)->nullable(false);
            $table->string('electoral_district_description', 200)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electoral_districts');
    }
};
