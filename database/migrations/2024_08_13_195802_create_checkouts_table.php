<?php

use App\Enums\Stage;
use App\Models\Reservation;
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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Reservation::class)->constrained()->cascadeOnDelete();
            $table->string('step');
            $table->string('status')->default(Stage::PENDENTE->value);
            $table->string('image')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
