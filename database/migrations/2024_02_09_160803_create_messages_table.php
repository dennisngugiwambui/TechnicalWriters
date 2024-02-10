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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('OrderId');
            $table->string('from');
            $table->string('from_phone');
            $table->string('from_email');
            $table->string('to');
            $table->string('to_email');
            $table->string('to_phone');
            $table->string('title');
            $table->string('date');
            $table->longText('message');
            $table->string('visible')->default('yes');
            $table->string('read_status')->default('no');
            $table->string('permission')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
