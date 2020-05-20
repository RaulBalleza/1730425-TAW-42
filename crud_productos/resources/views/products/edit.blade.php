@extends('layouts.app')

@section('content')
@php( $categories = \App\Product_categories::all() )

<style>
    .container {
        max-width: 450px;
    }

    .push-top {
        margin-top: 50px;
    }
</style>

<div class="card push-top">
    <div class="card-header">
        Edit & Update
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('products.update', $product->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" value="{{ $product->description }}" />
            </div>
            <div class="form-group">
                <label for="sale_price">Sale price</label>
                <input type="text" class="form-control" name="sale_price" value="{{ $product->sale_price }}" />
            </div>
            <div class="form-group">
                <label for="purchase_price">Purchase price</label>
                <input type="text" class="form-control" name="purchase_price" value="{{ $product->purchase_price }}" />
            </div>
            <div class="form-group">
                <label for="inventory">Inventory</label>
                <input type="text" class="form-control" name="inventory" value="{{ $product->inventory }}" />
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                    <option value="Other">Other</option>
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-danger">Update Product</button>
        </form>
    </div>
</div>
@endsection