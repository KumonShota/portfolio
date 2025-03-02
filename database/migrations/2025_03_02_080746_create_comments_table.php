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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained()->onDelete('cascade'); // レビューに紐づく
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 投稿者
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // 返信元のコメント
            $table->text('content'); // コメント内容
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
