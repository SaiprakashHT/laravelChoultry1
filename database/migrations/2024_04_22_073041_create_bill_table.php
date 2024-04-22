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
        Schema::create('bill', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('customer_address');
            $table->string('customer_gst');
            $table->string('bill_no');
            $table->string('paid');
            $table->string('paid_date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill');
    }
};
