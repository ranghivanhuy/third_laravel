@extends('layouts.master')
@section('title', 'View Categories')
@section('breadcumb')
<h1>
    View Categories
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('categories.index')}}">Categories</a></li>
    <li class="active">View Categories</li>
</ol>
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><a href="{{route('categories.create')}}" class="btn btn-success">Add new</a></h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover text-center">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Option</th>
                    </tr>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{++$key}}</td>
                        <td><a href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a></td>
                        <td>{{$category->description}}</td>
                        <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning" style="float: left">Edit</a>
                        <form action="#" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
