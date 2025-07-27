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
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('discount_percentage', 5, 2); // e.g., 15.50%
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('usage_limit')->nullable(); // Max uses allowed
            $table->unsignedInteger('used_count')->default(0);  // How many times used
            $table->timestamp('starts_at')->nullable(); // Optional start time
            $table->timestamp('expires_at')->nullable(); // Optional expiry
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_codes');
    }
};
