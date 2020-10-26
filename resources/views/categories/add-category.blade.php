@extends('layouts.master')

@section('title', 'Add Category')
@section('breadcumb')
<h1>
    Add Category
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('categories.index')}}">Category</a></li>
    <li class="active">Add Category</li>
</ol>
@endsection

@section('main-content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create a new Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter your category name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent ID</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name}}</option>
                                @foreach($category->cate as $child_first)
                                <option value="{{ $child_first->id }}">-> {{ $child_first->name}}</option>
                                    @foreach($child_first->cate as $child_second)
                                    <option value="{{ $child_second->id }}">->->{{ $child_second->name}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editor1">Description</label>
                        <textarea name="description" class="form-control ckeditor" id="editor1" rows="10"
                            placeholder="Enter Description">{{old('description')}}</textarea>
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