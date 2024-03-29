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
          {
        Schema::create('tennants', static function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name');
             $table->string('house', 1);
            $table->integer('appartment')->nullable();
            $table->dateTime('start_date');
            $table->integer('duration')->nullable();
            $table->decimal('amount', 8, 2)->default(0);
            $table->timestamps();

        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tennants');
    }
};
