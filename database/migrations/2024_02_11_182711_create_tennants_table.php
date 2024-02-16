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
        Schema::create('TennantForm', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name');
            $table->enum('house', ['A', 'B', 'C', 'S']);
            $table->unsignedSmallInteger('apartment_number');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('amount',  8,  2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tennants');
    }
};
