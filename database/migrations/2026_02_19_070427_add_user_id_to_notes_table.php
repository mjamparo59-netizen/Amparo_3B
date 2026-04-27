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
    // Only try to add the column if it DOES NOT exist yet
    if (!Schema::hasColumn('notes', 'user_id')) {
        Schema::table('notes', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
        });
    }

    // This part will remove the old 'userId' column if it is still there
    if (Schema::hasColumn('notes', 'userId')) {
        Schema::table('notes', function (Blueprint $table) {
            // If you have a foreign key on userId, drop it first
            // $table->dropForeign(['userId']); 
            $table->dropColumn('userId');
        });
    }
}

public function down(): void
{
    Schema::table('notes', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};