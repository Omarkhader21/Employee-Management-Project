<?php

use App\Models\Country;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class, 'country_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 100);
            $table->string('abbreviation', 10)->nullable();
            $table->string('state_code', 10)->nullable()->unique();
            $table->unique(['country_id', 'name']); // Ensures state names are unique per country
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
