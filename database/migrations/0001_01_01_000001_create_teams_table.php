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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('code')->unique();
            $table->string('avatar')->nullable();

            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(App\Models\Team::class)->index();
            $table->foreignIdFor(App\Models\User::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
