<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('region', 120)->nullable()->after('city');
        });

        DB::table('site_settings')
            ->whereRaw('LOWER(country) = ?', ['banten'])
            ->update([
                'region' => 'Banten',
                'country' => 'Indonesia',
            ]);
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('region');
        });
    }
};
