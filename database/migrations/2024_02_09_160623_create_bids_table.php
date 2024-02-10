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
        Schema::create('bids', function (Blueprint $table) {
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
            $table->text('comments');
            $table->string('files');
            $table->boolean('visible')->default(true);
            $table->string('writer_id');
            $table->string('writer_name');
            $table->string('writer_phone');
            $table->string('ucompleted_orders');
            $table->string('status')->default('bid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
