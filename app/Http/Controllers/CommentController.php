<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentReq;
use App\Http\Requests\UpdateCommentReq;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comment = Comment::paginate(10);

        return  CommentResource::collection($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentReq $request)
    {
        //
        $request['user_id'] = auth()->user()->id;
        $comment = Comment::create($request->all());
        return new CommentResource($comment->loadMissing(['comentator']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $comment = Comment::with('comentator:id,email,username,firstname,lastname')->findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentReq $request, $id)
    {
        //
        $comment = Comment::find($id);
        $comment->update($request->validated());
        return new CommentResource($comment->loadMissing('comentator:id,username'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Comment::destroy($id);
        return response()->json(['message' => 'Item deleted successfully.']);
    }
}
