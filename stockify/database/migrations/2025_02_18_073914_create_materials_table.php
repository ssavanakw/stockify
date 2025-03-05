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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable()->default(null);
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // Foreign key
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, drop foreign key constraints from other tables that reference 'materials'
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign(['material_id']);
        });

        // Then drop foreign key from 'materials' itself
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        // Now safely drop the materials table
        Schema::dropIfExists('materials');
    }
};
