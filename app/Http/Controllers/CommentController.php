<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // ✅ コメントを投稿する（通常のコメント & 返信）
    public function store(Request $request, Review $review)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'review_id' => $review->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id, // 返信の場合、親コメントのIDを設定
            'content' => $request->content,
        ]);
        return redirect()->route('reviews.show', $review)->with('success', 'コメントを投稿しました！');
    }
    // ✅ コメントを削除する（投稿者のみ）
    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', '削除権限がありません。');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'コメントを削除しました！');
    }
}
