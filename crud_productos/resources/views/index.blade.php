@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Description</td>
          <td>Sale price</td>
          <td>Purchase price</td>
          <td>Inventory</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($product as $products)
        <tr>
            <td>{{$products->id}}</td>
            <td>{{$products->name}}</td>
            <td>{{$products->description}}</td>
            <td>${{$products->sale_price}}</td>
            <td>${{$products->purchase_price}}</td>
            <td>{{$products->inventory}}</td>
            <td class="text-center">
                <a href="{{ route('products.edit', $products->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <form action="{{ route('products.destroy', $products->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection