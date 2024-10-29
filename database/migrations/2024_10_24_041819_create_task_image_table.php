<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_image', function (Blueprint $table) {
            $table->id('id_task_image');
            $table->foreignId('id_task')->nullable()->constrained('task', 'id_task')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_progress_task')->nullable()->constrained('progress_task', 'id_progress_task')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_image');
    }
};
