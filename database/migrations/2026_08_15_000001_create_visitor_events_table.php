<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_events', function (Blueprint $table) {
            $table->id();
            $table->string('path', 500);
            $table->string('route_name')->nullable();
            $table->string('ip_hash', 64);
            $table->string('user_agent_hash', 64)->nullable();
            $table->string('referer', 500)->nullable();
            $table->date('visited_on');
            $table->timestamp('visited_at');
            $table->timestamps();

            $table->index(['visited_on', 'path']);
            $table->index(['visited_on', 'ip_hash']);
            $table->index('visited_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_events');
    }
};
