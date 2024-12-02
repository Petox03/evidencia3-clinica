<?php

use App\Models\Customer;
use App\Models\PetType;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(PetType::class)->constrained()->onDelete('cascade');
            $table->integer('age');
            $table->foreignIdFor(Customer::class)->constrained()->onDelete('cascade');
            $table->boolean('is_hospitalized')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
