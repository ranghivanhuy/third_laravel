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
                    </div>
                    <div class="form-group">
                        <label>Product price</label>
                        <input type="text" class="form-control" name="price" id="price"
                            placeholder="Enter price's product" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <div class="photo-add">
                            <label for="photo" class="product-image"> Upload
                                <input type="file" name="photo" id="photo" class="form-control" style="display:none"/>
                            </label>
                            <div class="photo-preview">
                                <img id="photoPreview" src="" hidden="hidden" width="150px" height="150px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Image Detail</label>
                        <div class="image-add">
                            <label for="image" class="product-image">Upload detail
                                <input type="file" name="image[]" id="image"  class="form-control" multiple="multiple" style="display: none"/>
                            </label>
                            <output id="filesInfo"></output>
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
                    	            @include('products.child_cate', ['child_cate' => $cate_first])
                    	        @endforeach
                    	        </ul>
                    	    @endforeach
                    	</ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editor1">Product Description</label>
                        <textarea name="description" class="form-control ckeditor" id="editor1" rows="10"
                            placeholder="Enter description">{{old('description')}}</textarea>
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