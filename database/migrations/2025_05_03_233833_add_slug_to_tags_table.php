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
        Schema::table('tags', function (Blueprint $table) {
            if (!Schema::hasColumn('tags', 'slug')) { // ✅ Prevents duplicate column creation
                $table->string('slug')->unique()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            if (Schema::hasColumn('tags', 'slug')) { // ✅ Ensures rollback only if column exists
                $table->dropColumn('slug');
            }
        });
    }
};
