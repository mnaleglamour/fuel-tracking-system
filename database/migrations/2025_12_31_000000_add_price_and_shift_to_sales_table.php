<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('price_per_litre', 10, 2)->nullable()->after('amount');
            $table->foreignId('pump_shift_id')->nullable()->after('price_per_litre')->constrained('pump_shifts')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeignIdFor('pump_shifts');
            $table->dropColumn(['price_per_litre', 'pump_shift_id']);
        });
    }
};
