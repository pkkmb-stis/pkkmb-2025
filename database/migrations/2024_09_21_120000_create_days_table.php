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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // PKKMBH1, PKKMBH2, dst
            $table->date('date');             // 2024-09-01, 2024-09-02, dst  
            $table->string('description')->nullable(); // Hari pertama PKKMB, dst
            $table->timestamps();
            $table->index('name');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
