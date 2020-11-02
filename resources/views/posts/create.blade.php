@extends('layouts.app')

@section('title')
    @if(isset($post))
    Edit Post
    @else 
    Create Post
    @endif
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post'}}</div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store')}}" method='POST' enctype='multipart/form-data'>
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id='title' name='title' value='{{ isset($post) ? $post->title : ""}}'>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class='form-control' id="description" cols="15" rows="2">{{ isset($post) ? $post->description : ""}}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value='{{ isset($post) ? $post->content : ""}}'>
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" id='published_at' name='published_at' value='{{ isset($post) ? $post->published_at : ""}}'>
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <img src="{{ URL::to('/storage/'.$post->image) }}" alt="" style='width:100%'>
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id='image' name='image' value=''>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                @if(isset($post))
                                    @if($category->id==$post->category_id)
                                        selected
                                    @endif
                                @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                @if($tags->count()>0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}"
                                @if(isset($post))
                                    @if($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                            >{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                
                <div class="form-group">
                    <button type='submit' class="btn-success">{{ isset($post) ? 'Edit Post' : 'Add Post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <script>
        flatpickr('#published_at',{
            enableTime:true
        })


        $(document).ready(function() {
            $('.tag-selector').select2();
        });
    </script>



@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection