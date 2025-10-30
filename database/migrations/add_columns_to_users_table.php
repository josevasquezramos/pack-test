<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'fullname')) {
                    $table->string('fullname')->nullable()->after('name');
                }
                if (! Schema::hasColumn('users', 'dni')) {
                    $table->string('dni', 15)->nullable()->unique()->after('fullname');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'fullname')) {
                    $table->dropColumn('fullname');
                }
                if (Schema::hasColumn('users', 'dni')) {
                    $table->dropColumn('dni');
                }
            });
        }
    }
};
