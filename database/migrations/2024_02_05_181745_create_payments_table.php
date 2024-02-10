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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('writer_id');
            $table->string('writer_name');
            $table->string('writer_phone');
            $table->string('amount');
            $table->string('trasaction_date');
            $table->string('TransactionType');
            $table->string('comments');
            $table->string('paid_by');
            $table->string('paid_date');
            $table->string('status')->default('unconfirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
