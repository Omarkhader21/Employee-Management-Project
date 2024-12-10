<?php

use App\Models\State;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(State::class, 'state_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 100);
            $table->string('postal_code', 10)->nullable();
            $table->integer('population')->nullable();
            $table->unique(['state_id', 'name']); // Ensures unique city names per state
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
