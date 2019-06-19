<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\KhoaHoc;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommentKhongThuocUser;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
        $this->middleware('isAdmin')->only('CommentAll');
    }
    public function CommentAll()
    {
        return CommentResource::collection(Comment::all()->sortByDesc("created_at"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KhoaHoc $KhoaHoc)
    {
        return CommentResource::collection($KhoaHoc->comment->sortByDesc("created_at"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, KhoaHoc $KhoaHoc)
    {
        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->KhoaHoc_id = $KhoaHoc->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();

        return response([
            'data' => new CommentResource($comment),
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $Comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, KhoaHoc $KhoaHoc, Comment $Comment)
    {
        $this->CommentThuocUser($Comment);
        $Comment->update($request->all());
        // $Comment->save();

        return response([
            'data'=> new CommentResource($Comment),
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhoaHoc $KhoaHoc, Comment $Comment)
    {
        if(Auth::user()->level_id==1 || !$this->CommentThuocUser($Comment))
        {
            $Comment->delete();
            return \response()->json([
                'data' => "Xóa thành công comment $Comment->id",
            ],202);
        }
    }

    public function CommentThuocUser(Comment $Comment)
    {
        $user = Auth::user();
        if($user->id != $Comment->user_id )
            throw new CommentKhongThuocUser;
    }
}
