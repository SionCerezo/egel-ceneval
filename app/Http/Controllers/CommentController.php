<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'comment' => 'present',
            'postulacion_id' => 'required|exists:postulaciones,id',
        ]);
        $comment = new Comment($request->all());
        $comment->user_id = Auth::user()->id;

        $comment->save();

        $response = ['success'=>true];

        return response()->json($response);
    }
}
