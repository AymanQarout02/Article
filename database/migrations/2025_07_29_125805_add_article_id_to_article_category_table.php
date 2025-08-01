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
        Schema::table('article_category', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
        Schema::table('article_category', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_category', function (Blueprint $table) {
            //
        });
    }
};
