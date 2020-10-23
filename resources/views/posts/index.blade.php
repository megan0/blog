@extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create')}}" class="btn btn-success">AddPost</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            @if($posts->count()>0)
            <table class='table'>
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ URL::to('/storage/'.$post->image) }}" alt="" width=120 height=70 >
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            @if(!$post->trashed())
                                <td>
                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                </td>
                            @endif
                            <td>
                                <form action="{{route('posts.destroy',$post->id)}}" method='POST'>
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' class="btn btn-danger btn-sm">
                                        {{$post->trashed() ? 'Delete' : 'Trash'}}
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                   
                </tbody>
            </table>
            @else
                <h3 class="text-center">No Posts.</h3>
            @endif
            <!-- <form action="" method='POST' id='deleteCategoryForm'>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center bold">Are you sure you want to delete this category?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> -->
        </div>
    </div>
@endsection