@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Welcome, {{ Auth::user()->name }}</div>

                <div class="card-body ">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card border-secondary">

                                <div class="card-body">
                                    <img style="width: 100%; height: 15rem" src="https://cdn2.iconfinder.com/data/icons/e-commerce-line-4-1/1024/open_box4-512.png" alt="" srcset="">
                                </div>
                                <div class="card-footer bg-transparent border-success">
                                    <b>PRODUCTS</b>
                                    <a href="{{ route('products.index')}}" class="btn btn-success float-right">Go <i class="fas fa-chevron-right"></i></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-secondary">

                                <div class="card-body">
                                    <img style="width: 100%; height: 15rem" src="https://cdn0.iconfinder.com/data/icons/business-startup-15/51/Asset_58-512.png" alt="" srcset="">
                                </div>
                                <div class="card-footer bg-transparent border-success">
                                    <b>PRODUCT CATEGORIES</b>
                                    <a href="{{ route('product_categories.index')}}" class="btn btn-success float-right">Go <i class="fas fa-chevron-right"></i></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-secondary">

                                <div class="card-body">
                                    <img style="width: 100%; height: 15rem" src="https://cdn.onlinewebfonts.com/svg/img_570336.png" alt="" srcset="">
                                </div>
                                <div class="card-footer bg-transparent border-success">
                                    <b>USERS</b>
                                    <a href="#" class="btn btn-success float-right disabled">Go <i class="fas fa-chevron-right"></i></a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection