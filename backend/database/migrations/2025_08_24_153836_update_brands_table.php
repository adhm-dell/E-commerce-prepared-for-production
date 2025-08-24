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
        Schema::table('brands', function (Blueprint $table) {
            // rename column 'name' to 'name_en'
            $table->renameColumn('name', 'name_en');

            // add new column 'name_ar' after 'name_en'
            $table->string('name_ar')->after('name_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            // drop name_ar
            $table->dropColumn('name_ar');

            // rename name_en back to name
            $table->renameColumn('name_en', 'name');
        });
    }
};
