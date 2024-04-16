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
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Use string method to define 'name' column
            $table->string('address'); // Use string method to define 'address' column
            $table->timestamps();
            $table->foreignId('region_id')->constrained('regions'); // Use foreignId method to define 'region_id' column with a foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locals');
    }
};
