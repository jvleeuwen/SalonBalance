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
        Schema::table('treatments', function (Blueprint $table) {
            if (!Schema::hasColumn('treatments', 'customer_id')) {
                $table->unsignedBigInteger('customer_id');
                $table->foreign('customer_id')->references('id')->on('customers');
            }
            if (!Schema::hasColumn('treatments', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('treatments', 'price')) {
                $table->decimal('price', 8, 2);
            }
            if (!Schema::hasColumn('treatments', 'version')) {
                $table->integer('version')->default(1);
            }
            if (!Schema::hasColumn('treatments', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn(['customer_id', 'name', 'price', 'version', 'created_at', 'updated_at']);
        });
    }
};
?>