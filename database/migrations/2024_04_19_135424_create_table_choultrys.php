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
        Schema::create('table_choultrys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('pin');
            $table->char('phone_number', 12)->nullable();
            $table->string('email')->unique();
            $table->string('pname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_choultrys');
    }
};
