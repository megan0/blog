<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class WelcomeController extends Controller
{
    public function index(){
        $search=request()->query('search');

        if($search){

            $post=Post::where('title','LIKE',"%{$search}%")->simplePaginate(4);

        }
        else{
            $post=Post::simplePaginate(4);
        }
        return view('welcome')
        ->with('posts',$post)
        ->with('categories',Category::all())
        ->with('tags',Tag::all());
    }
}
