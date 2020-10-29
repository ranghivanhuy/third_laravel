@extends('layouts.master')
@section('title', 'List All Product')
@section('breadcumb')
<h1>
    List All Product
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('products.index')}}">Product</a></li>
    <li class="active">List All product</li>
</ol>
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><a href="{{route('products.create')}}" class="btn btn-success">Add new</a></h3>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>List categories</th>
                        <th>Option</th>
                    </tr>
                    @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ ($products->currentpage() - 1) * $products->perpage() + ++$key }}</td>
                        <td><img src="{{asset('/storage/products/thumbnail/'.$product->photo)}}" width="50px" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>
                            @foreach($product->product_category as $pro_cate)
                            <p>{{ $pro_cate->name }}</p>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger open-delete-product"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {{$products->render('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
