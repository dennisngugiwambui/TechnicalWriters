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
            $table->id()->startingValue(1000);;
            $table->string('assignmentType');
            $table->string('typeOfService');
            $table->string('topicTitle');
            $table->string('discipline');
            $table->text('pages');
            $table->string('deadline');
            $table->string('cpp');
            $table->decimal('price', 8, 2);
            $table->text('comments');
            $table->boolean('visible')->default(false);
            $table->string('employee_id');
            $table->string('employee_name');
            $table->string('employee_phone');
            $table->string('writer_id');
            $table->string('writer_name');
            $table->string('writer_phone');

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
