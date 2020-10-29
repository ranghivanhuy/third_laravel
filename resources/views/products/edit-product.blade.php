@extends('layouts.master')

@section('title', 'Edit product')
@section('breadcumb')
<h1>
    Edit Product
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('products.index')}}">Product</a></li>
    <li class="active">Edit product</li>
</ol>
@endsection

@section('main-content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('products.update', $prodById['id']) }}" method="POST" role="form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your product name"
                            value="{{  $prodById['name'] }}">
                            @error('name')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" id="price"
                            placeholder="Enter price's product" value="{{$prodById['price']}}">
                            @error('price')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="primary-image" class="col-sm-2 control-label">Product photo</label>
                        <div class="col-sm-10">
                            <div class="image-add">
                                <label for="primary-image" class="product-image">Upload primary
                                    <input type="file" name="photo" id="primary-image" style="display: none"/>
                                </label>
                            </div>
                            <div id="primary-image-to-upload">
                                <div id="display-primary-image">
                                    <img id="photoPreview" src="{{asset('storage/products/thumbnail/'. $prodById->photo)}}" alt="">
                                    <button type="button" data-id="{{$prodById->id}}" class="delete-image-primary">X</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="multiple-image-multiple" class="col-sm-2 control-label">Image Detail</label>
                        <div class="col-sm-10">
                            <div class="image-add">
                                <label for="multiple-image" class="product-image">Upload multiple
                                    <input type="file" name="image[]" id="multiple-image" multiple style="display: none"/>
                                </label>
                            </div>
                            <div id="multiple-image-to-upload">
                                @foreach($prodById->product_image as $productImage)
                                <div class="display-multiple-image">
                                    <img id="photoPreview" src="{{asset('storage/products/images/thumbnail/'. $productImage->image)}}" alt="">
                                    <button type="button" class="delete-image-multiple" data-id="{{ $productImage->id }}" value="{{$productImage->id}}">X</button>
                                </div>
                                @endforeach
                            </div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <div class="checkbox">
                            <ul>
                    	    @foreach ($categories as $value)
                    	        <li>
                                    <label>
                                    <input type="checkbox" name="category_id[]"  value="{{ $value->id }}" {{in_array($value->id, $productCategory) ? "checked":"" }}>
                            
                                    {{ $value->name }}
                                    </label>
                                </li>
                    	        <ul>
                    	        @foreach ($value->cate as $cate_first)
                    	            @include('products.child_cate', ['child_cate' => $cate_first])
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
                        <label for="editor1">Description</label>
                        <textarea name="description" class="form-control ckeditor" id="editor1" rows="10"
                            placeholder="Enter description">{{ $prodById['description'] }}</textarea>
                            @error('description')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-warning btn-edit-product" id="{{ $prodById->id }}" data-id="{{ $prodById->id }}">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection