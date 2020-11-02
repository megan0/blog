<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\VerifyCategoriesCount;
use App\Models\Tag;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware(VerifyCategoriesCount::class)->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image=$request->image->store('posts');

        $post=Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'published_at'=>$request->published_at,
            'user_id'=>auth()->user()->id,
            'image'=>$image,
            'category_id'=>$request->category
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }


        session()->flash('success','Post Created.');

        return redirect(route('posts.index'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        $data=$request->only(['title','description','content','published_at']);

        if($request->hasFile('image')){

            $post->deleteImage();

            $image=$request->image->store('posts');
            $data['image']=$image;

        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }


        $post->update($data);

        session()->flash('success','Post Updated.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();

        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }
        else{
            $post->delete();
        }

        session()->flash('success','Post Deleted.');

        return redirect(route('posts.index'));


    }

    /**
     * Display all trashed posts.
     * 
     * @return \Illuminate\Http\Response
     */

    public function trashed(){

        $trashed=Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($trashed);

    }

    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        session()->flash('success','Post Restored.');
        return redirect(route('posts.index'));
    }
}
