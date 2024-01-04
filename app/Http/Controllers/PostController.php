<?php

namespace App\Http\Controllers;

use view;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //
    public function showCreateForm(){
        return view('create-post');
    }
    
    public function storeNewPost(Request $request){
        
   
        $incomingFields = $request ->validate([
            'title'=>'required',
            'body'=>'required',
        ]);


        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();


     $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('Success','Succesfully created a new posted');
    }

    public function showSinglePost(Post $post){
        $post['body']= strip_tags(Str::markdown($post->body),'<b><strong><ul><ol><li><h3>');
        return view('single-post',['post'=>$post]);
    }
}
