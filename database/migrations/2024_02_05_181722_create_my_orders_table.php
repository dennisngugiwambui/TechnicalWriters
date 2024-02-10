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
        Schema::create('my_orders', function (Blueprint $table) {
            $table->id();
            $table->string('OrderId');
            $table->string('assignmentType');
            $table->string('typeOfService');
            $table->string('topicTitle');
            $table->string('discipline');
            $table->text('pages');
            $table->string('deadline');
            $table->string('cpp');
            $table->decimal('price', 8, 2);
            $table->text('comments')->nullable();
            $table->string('files');
            $table->boolean('visible')->default(true);
            $table->string('writer_id');
            $table->string('writer_name');
            $table->string('writer_phone');
            $table->string('status')->default('current');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_orders');
    }
};
