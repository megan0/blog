@extends('layouts.app')

@section('title')
    @if(isset($category))
    Edit Category
    @else 
    Create Category
    @endif
@endsection

@section('content')

    
    <div class="card card-default">
        <div class="card-header">{{ isset($category) ? 'Edit Category' : 'Create Category'}}</div>
        <div class="card-body">
            @if($errors->any())
                <alert class="alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </alert>
            @endif
            <form action="{{isset($category) ? route('categories.update',$category->id) : route('categories.store')}}" method='POST'>
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id='name' name='name' value='{{ isset($category) ? $category->name : ""}}'>
                </div>
                <div class="form-group">
                    <button class="btn-success">{{ isset($category) ? 'Edit Category' : 'Create Category'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection