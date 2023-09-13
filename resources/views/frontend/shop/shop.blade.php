@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/main.shop') }}</h3>
        </div>
    </div>
</div>

<div class="container">
    @if(count(\App\Models\Product::all()))
        <div class="row">
        @if(count(App\Models\Product::getUncategorizedProducts()))
            @foreach(App\Models\Product::getUncategorizedProducts() as $product)
                <div class="col-md-4">
                @include('frontend/shop.product_simple_card')
                </div>
            @endforeach
        @endif

        @foreach($categories as $category)
        
            @foreach($category->getProducts() as $product)
                <div class="col-md-4">
                @include('frontend/shop.product_simple_card') 
                </div>
            @endforeach

            @if(!$loop->last)
            @endif
        @endforeach
    </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ __('frontend/shop.no_products_exists') }}
                </div>
            </div>   
        </div>
    @endif
</div>
@endsection
