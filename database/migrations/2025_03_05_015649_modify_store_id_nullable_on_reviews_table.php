<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->change(); // ✅ ここで nullable に変更
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable(false)->change(); // 元に戻す
        });
    }
};
