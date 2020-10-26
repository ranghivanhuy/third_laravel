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
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" id="price"
                            placeholder="Enter price's product" value="{{$prodById['price']}}">
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <div class="photo-add">
                            <label for="photo" class="product-image"> Upload
                                <input type="file" name="photo" id="photo" class="form-control" style="display:none"/>
                            </label>
                            <div class="photo-preview">
                                <img id="photoPreview" src="{{asset('storage/products/thumbnail/'. $prodById->photo)}}" width="150px" height="150px" alt="">
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
                            <img src="{{asset('storage/products/images/thumbnail/'. $prodById)}}" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <div class="checkbox">
                            <ul>
                    	    @foreach ($categories as $checked)
                    	        <li>
                                    <label>
                                    <input type="checkbox" name="category_id[]"  value="{{ $checked->id }}" @foreach ($checked->product_category as $value)
                                @if(in_array($value['id'], $checked)) 'checked="checked"' @endif
                           @endforeach />
                                    {{ $checked->name }}
                                    </label>
                                </li>
                    	        <ul>
                    	        @foreach ($checked->cate as $cate_first)
                    	            @include('products.child_cate', ['child_cate' => $cate_first])
                    	        @endforeach
                    	        </ul>
                    	    @endforeach
                    	</ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editor1">Description</label>
                        <textarea name="description" class="form-control ckeditor" id="editor1" rows="10"
                            placeholder="Enter description">{{ $prodById['description'] }}</textarea>
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