<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('api_request_logs')) {
            return;
        }

        Schema::create('api_request_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('method', 10);
            $table->string('path', 500);
            $table->string('query_string', 1000)->nullable();
            $table->unsignedSmallInteger('status_code');
            $table->string('ip_address', 45);
            $table->string('user_agent', 500)->nullable();
            $table->unsignedSmallInteger('response_time_ms')->nullable();
            $table->timestamp('created_at')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_request_logs');
    }
};
