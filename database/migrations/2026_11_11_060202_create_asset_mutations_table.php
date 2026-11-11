<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_mutations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->onDelete('cascade');
            $table->foreignId('from_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('to_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang memindahkan
            $table->date('mutation_date');
            $table->text('notes')->nullable(); // Alasan pemindahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_mutations');
    }
};