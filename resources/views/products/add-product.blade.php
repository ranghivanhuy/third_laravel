@extends('layouts.master')

@section('title', 'Add product')
@section('breadcumb')
<h1>
    Add Product
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('products.index')}}">Product</a></li>
    <li class="active">Add product</li>
</ol>
@endsection

@section('main-content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create a new Product</h3>
            </div>
            <form action="{{ route('products.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your product name"
                            value="{{old('name')}}">
                            @error('name')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label>Product price</label>
                        <input type="text" class="form-control" name="price" id="price"
                            placeholder="Enter price's product" value="{{old('price')}}">
                            @error('price')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="primary-image" class="col-sm-2 control-label">Product photo</label>
                        <div class="col-sm-10">
                            <div class="image-add">
                                <label for="primary-image" class="product-image">Upload primary
                                    <input type="file" name="photo" id="primary-image"  class="form-control" style="display: none"/>
                                </label>
                            </div>
                            @error('photo')
                            <div class="error">{{$message}}</div>
                            @enderror
                            <div id="primary-image-to-upload"></div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="multiple-image-multiple" class="col-sm-2 control-label">Image Detail</label>
                        <div class="col-sm-10">
                            <div class="image-add">
                                <label for="multiple-image" class="product-image">Upload multiple
                                    <input type="file" name="image[]" id="multiple-image"  class="form-control" multiple style="display: none"/>
                                </label>
                            </div>
                            @error('image')
                            <div class="error">{{$message}}</div>
                            @enderror
                            <div id="multiple-image-to-upload"></div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <div class="checkbox">
                            <ul>
                    	    @foreach ($categories as $category)
                    	        <li>
                                    <label>
                                    <input type="checkbox" name="category_id[]" value="{{ $category->id }}">
                                    {{ $category->name }}
                                    </label>
                                </li>
                    	        <ul>
                    	        @foreach ($category->cate as $cate_first)
                    	            @include('products.child-cate-add', ['child_cate' => $cate_first])
                    	        @endforeach
                    	        </ul>
                    	    @endforeach
                            </ul>
                            @error('category_id')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editor1">Product Description</label>
                        <textarea name="description" class="form-control ckeditor" id="editor1" rows="10"
                            placeholder="Enter description">{{old('description')}}</textarea>
                            @error('description')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection