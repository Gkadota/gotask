<?php
namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getCommentsByTask($taskId);

    public function createComment(string $commentBody, $userId, $taskId);

    public function updateComment($commentId, string $commentBody);

    public function deleteComment($commentId);

    public function getCommentById($commentId);
}