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
        Schema::disableForeignKeyConstraints();

        Schema::table('pumps', function (Blueprint $table) {
            if (Schema::hasColumn('pumps', 'fuel_id')) {
                $table->dropColumn('fuel_id');
            }
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pumps', function (Blueprint $table) {
            if (!Schema::hasColumn('pumps', 'fuel_id')) {
                $table->unsignedBigInteger('fuel_id')->nullable();

                $table->foreign('fuel_id')
                      ->references('id')
                      ->on('fuels')
                      ->onDelete('cascade');
            }
        });
    }
};
