@extends('layouts.master')
@section('title', 'List All Categories')
@section('breadcumb')
<h1>
    List All Categories
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('products.index')}}">Categories</a></li>
    <li class="active">List All Categories</li>
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
                    @foreach ($categories as $key => $category)
                    <tr id="category{{$category->id}}" >
                        <td>{{++$key}}</td>
                        <td><a href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a></td>
                        <td>{{$category->description}}</td>
                        <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <a class="btn btn-danger open-delete" data-id="{{$category->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<!-- MODAL SECTION -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Notify</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="btn-delete" value="delete" class="btn btn-danger">Yes</button>
                <input type="hidden" id="id-delete" name="id" value="0">
            </div>
        </div>
    </div>
</div>
@endsection
