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
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('name', 'name_en');
            $table->string('name_ar')->after('name_en')->nullable();

            $table->renameColumn('description', 'description_en');
            $table->string('description_ar')->after('description_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->renameColumn('name_en', 'name');

            $table->dropColumn('description_ar');
            $table->renameColumn('description_en', 'description');
        });
    }
};
