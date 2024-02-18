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
            // $table->enum('property_type', ['house', 'apartment']);
            // $table->unsignedSmallInteger('property_number')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('amount', 8, 2)->default(0);
            // $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreignIdFor(\Illuminate\Foundation\Auth\User::class)->constrained()->onDelete('cascade');
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
