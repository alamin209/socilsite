<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;
use auth;
use DB;

class PostsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      return view("welcome");
    }

    public function allpost() {
        
        $allpost = DB::table("posts")
                        ->leftJoin('profiles', 'profiles.user_id', "posts.user_id")
                        ->leftJoin("users", "users.id", "posts.user_id")
                        ->orderBy('posts.id','desc')
                        ->get()->take(3);
        return($allpost);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPost(Request $request) {
        $content = $request->content;
        $createpost = DB::table('posts')
                ->insert(['user_id' => Auth::user()->id, 'content' => $content, 'status' => 0]);
        if($createpost){
            $allpost = DB::table("posts")
                        ->leftJoin('profiles', 'profiles.user_id', "posts.user_id")
                        ->leftJoin("users", "users.id", "posts.user_id")
                        ->orderBy('posts.id','desc')
                        ->get()->take(3);
           return $allpost;
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts) {
        //
    }

}
