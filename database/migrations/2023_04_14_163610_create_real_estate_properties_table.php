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
        Schema::create('real_estate_properties', function (Blueprint $table) {
            $table->id();
			$table->string('name', 128)->nullable();
			$table->enum('real_estate_type', [
				'House',
				'Department',
				'Land',
				'Commercial_Ground'
			])->default('House');
			$table->string('street', 128)->nullable();
			$table->string('external_number', 12)->nullable();
			$table->string('internal_number', 12)->nullable();
			$table->string('neighborhood', 128)->nullable();
			$table->string('city', 64)->nullable();
			$table->string('country', 2)->nullable();
			$table->unsignedInteger('rooms')->nullable();
			$table->decimal('bathrooms')->nullable();
			$table->string('comments', 128)->nullable(); // should be text
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_properties');
    }
};
