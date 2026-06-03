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
        if (!Schema::hasTable('treatments')) {
            Schema::create('treatments', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 8, 2);
                $table->unsignedBigInteger('customer_id');
                $table->foreign('customer_id')->references('id')->on('customers');
                $table->timestamps();
            });
        }

        Schema::table('treatments', function (Blueprint $table) {
            if (!Schema::hasColumn('treatments', 'version')) {
                $table->integer('version')->default(1);
            }
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
?>