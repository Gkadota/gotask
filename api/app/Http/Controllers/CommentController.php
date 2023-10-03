<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\ShowCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ShowCommentRequest $request)
    {
        $comments = $this->commentRepo->getCommentsByTask($request->task_id);

        return response()->json($comments);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $newComment =  $this->commentRepo->createComment($request->body, $request->user_id, $request->task_id);

        $newCommentWithUser =  $this->commentRepo->getCommentById($newComment['id']);

        return response()->json($newCommentWithUser, Response::HTTP_CREATED);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request)
    {
        $isCommentUpdated = $this->commentRepo->updateComment($request->comment_id, $request->body);

        return response()->json(['success' => (bool) $isCommentUpdated]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateCommentRequest $request)
    {
        $isCommentDeleted = $this->commentRepo->deleteComment($request->comment_id);

        return response()->json(['success' => (bool) $isCommentDeleted]);
    }
}
