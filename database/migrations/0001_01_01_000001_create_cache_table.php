<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('cache', static function (Blueprint $table): void {
            $table->string(column: 'key')->primary();
            $table->mediumText(column: 'value');
            $table->integer(column: 'expiration');
        });

        Schema::create('cache_locks', static function (Blueprint $table): void {
            $table->string(column: 'key')->primary();
            $table->string(column: 'owner');
            $table->integer(column: 'expiration');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
