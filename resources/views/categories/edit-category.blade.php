@extends('layouts.master')

@section('title', 'Edit Category')
@section('breadcumb')
<h1>
    Edit Category
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('categories.index')}}">Category</a></li>
    <li class="active">Edit Category</li>
</ol>
@endsection

@section('main-content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Category</h3>
            </div>
            <form action="{{ route('categories.update', $cateById->id) }}" method="POST" role="form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your category name"
                            value="{{$cateById->name}}">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent ID</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                @if($category->id != $cateById->id)
                                <option value="{{ $category->id }}" {{ $category->id === $cateById->parent_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @foreach($category->cate as $child_first)
                                    @if($child_first->id != $cateById->id)
                                    <option value="{{ $child_first->id }}" {{ $child_first->id === $cateById->parent_id ? 'selected' : '' }}> ->{{ $child_first->name }}</option>
                                        @foreach($child_first->cate as $child_second)
                                        @if($child_second->id != $cateById->id)
                                        <option value="{{ $child_second->id }}" {{ $child_second->id === $cateById->parent_id ? 'selected' : '' }}> ->->{{ $child_second->name }}</option>
                                        @endif
                                        @endforeach
                                    @endif
                                    @endforeach
                                @endif
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editor1">Description</label>
                        <textarea name="description" class="form-control ckeditor" id="editor1" rows="10"
                            placeholder="Enter Description">{{ $cateById->description }}</textarea>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection