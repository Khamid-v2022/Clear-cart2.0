@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/main.home') }}</h3>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-white">{{ __('frontend/main.top_seller_title') }}</h4>
                <div class="row">
                    @foreach(App\Models\Product::orderByDesc('sells')->limit(6)->get() as $bestsellerProduct)
                    <div class="col-lg-4 col-sm-6 mt-3">
                        <a href="{{ route('product-page', $bestsellerProduct->id) }}" style="text-decoration: none;">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="k-portlet__head-title"> {{ $bestsellerProduct->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="k-widget-20__label">
                                        <b>{{ __('backend/dashboard.bestseller.price') }}</b>
                                            {{ $bestsellerProduct->getFormattedPrice() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
       
    </div>

</div>
@endsection
