<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getCommentsByTask($taskId)
    {
        return Comment::findWhere('task_id' , $taskId);
    }

    public function createComment(string $commentBody, $userId, $taskId)
    {
        return Comment::create([
            'body'    => $commentBody,
            'user_id' => $userId,
            'task_id' => $taskId,
        ]);
    }

    public function updateComment($commentId, string $commentBody)
    {
        return Comment::whereId($commentId)->update([
            'body' => $commentBody
        ]);
    }

    public function deleteComment($commentId)
    {
        return Comment::destroy($commentId);
    }

    public function getCommentById($commentId)
    {
        return Comment::with('user')->find($commentId);
    }
}
