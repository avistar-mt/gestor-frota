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
        Schema::create('model_vehicle_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_vehicle_id')->nullable()->constrained('model_vehicles')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('model_vehicle_user', function (Blueprint $table) {
            $table->dropForeign(['model_vehicle_id']);
            $table->dropForeign(['user_id']);

            $table->dropColumn(['model_vehicle_id', 'user_id']);
        });
        
        Schema::dropIfExists('model_vehicle_user');
    }
};
