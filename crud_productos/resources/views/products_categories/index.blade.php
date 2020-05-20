@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="">
      <div class="card">
        <div class="card-header" style="">
          <b>CATEGORIES</b>
          <a href="{{ route('product_categories.create')}}" class="btn btn-success float-right">Add <i class="fas fa-plus-circle"></i></a>
        </div>

        <div class="card-body">
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
                  <td class="text-center">Action</td>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td class="text-center">
                    <a href="{{ route('product_categories.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit <i class="fas fa-pen"></i></a>
                <form action=" {{ route('product_categories.destroy', $category->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type=" submit">Delete <i class="fas fa-minus-circle"></i></button>
                      </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>


    @endsection