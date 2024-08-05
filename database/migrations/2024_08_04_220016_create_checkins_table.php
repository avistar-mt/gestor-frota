<?php

use App\Models\User;
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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->enum('step', ['wheels', 'bodywork', 'lights', 'document']);
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkins');
    }
};
