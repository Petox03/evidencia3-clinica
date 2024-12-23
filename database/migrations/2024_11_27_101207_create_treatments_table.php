<?php

use App\Models\Medicine;
use App\Models\Pet;
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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pet::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Medicine::class)->constrained()->onDelete('cascade');
            $table->integer('dose');
            $table->time('administration_time');
            $table->boolean('is_in_treatment')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
