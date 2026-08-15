<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('mark', 20)->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });

        $now = now();
        DB::table('service_technologies')->insert([
            ['name' => 'Laravel', 'mark' => 'Lv', 'is_active' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'PHP', 'mark' => 'PHP', 'is_active' => true, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'JavaScript', 'mark' => 'JS', 'is_active' => true, 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MySQL', 'mark' => 'SQL', 'is_active' => true, 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'PostgreSQL', 'mark' => 'PG', 'is_active' => true, 'sort_order' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WordPress', 'mark' => 'WP', 'is_active' => true, 'sort_order' => 6, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'GitHub', 'mark' => 'GH', 'is_active' => true, 'sort_order' => 7, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'OpenAI', 'mark' => 'AI', 'is_active' => true, 'sort_order' => 8, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('service_technologies');
    }
};
