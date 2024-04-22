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
        Schema::table('outward_form', function (Blueprint $table) {
            //
            $table->char('user_id')->nullable()->after('amount');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outward_form', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');

        });
    }
};
