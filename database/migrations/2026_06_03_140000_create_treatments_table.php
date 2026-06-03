<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('treatments')) {
            Schema::create('treatments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->decimal('price', 8, 2);
                $table->string('version');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('treatments', function (Blueprint $table) {
        $table->dropForeign(['customer_id']);
    });
    Schema::dropIfExists('treatments');
}
};