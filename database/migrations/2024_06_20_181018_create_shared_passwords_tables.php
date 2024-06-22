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
        Schema::create('shared_passwords', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('password');
            $table->string('mac')->nullable();
            $table->timestamp('expiration')->default(now()->addDay());
            $table->integer('openings')->default(1);
            $table->string('passphase')->nullable();
            $table->string('link')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_passwords_tables');
    }
};
