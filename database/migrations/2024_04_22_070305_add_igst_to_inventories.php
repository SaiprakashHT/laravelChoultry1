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
        Schema::table('inventories', function (Blueprint $table) {
            //
            $table->string('igst')->nullable();
            $table->string('sgst');
            $table->string('cgst');
            $table->string('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            //
            $table->dropColumn('igst');
            $table->dropColumn('sgst');
            $table->dropColumn('cgst');
            $table->dropColumn('user_id');

        });
    }
};
