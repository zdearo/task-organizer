<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', TaskStatusEnum::toArray('value'));
            $table->enum('priority', TaskPriorityEnum::toArray('value'));
            $table->dateTime('due_date')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->foreignIdFor(\App\Models\Team::class, 'team_id');
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
