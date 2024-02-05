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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('assignmentType');
            $table->string('orderId');
            $table->string('taskSize');
            $table->string('title');
            $table->text('description');
            $table->string('word_count');
            $table->decimal('price', 8, 2);
            $table->boolean('visible')->default(false);
            $table->string('deadline');
            $table->text('comments')->nullable();
            $table->string('file');
            $table->string('writer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
