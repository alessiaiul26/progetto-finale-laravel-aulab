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
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')
                ->after('password')
                ->nullable();
            $table->string('phone')
                ->after('date_of_birth')
                ->nullable();
            $table->longText('biography')
                ->after('phone')
                ->nullable();
            $table->string('profile_image')
                ->after('biography')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'phone',
                'biography',
                'profile_image',
            ]);
        });
    }
};
