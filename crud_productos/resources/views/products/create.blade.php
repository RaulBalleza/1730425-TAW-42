@extends('layouts.app')

@section('content')
@php( $categories = \App\Product_categories::all() )

<div class="card push-top">
  <div class="card-header">
    Add Product
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
    <form method="post" action="{{ route('products.store') }}">
      <div class="form-group">
        @csrf
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" />
      </div>
      <div class="form-group">
        <label for="email">Description</label>
        <input type="text" class="form-control" name="description" />
      </div>
      <div class="form-group">
        <label for="phone">Sale price</label>
        <input type="number" class="form-control" name="sale_price" />
      </div>
      <div class="form-group">
        <label for="password">Purchase price</label>
        <input type="number" class="form-control" name="purchase_price" />
      </div>
      <div class="form-group">
        <label for="password">Inventory</label>
        <input type="number" class="form-control" name="inventory" />
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
      <button type="submit" class="btn btn-block btn-success">Submit</button>
    </form>
  </div>
</div>
@endsection