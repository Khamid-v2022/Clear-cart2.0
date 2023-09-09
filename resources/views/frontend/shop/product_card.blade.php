<div class="card card-product card-hover mb-15">
    @if($product->isSale())
    <div class="product-tag product-tag-sale">
        <span class="product-tag-percent">
            {{ __('frontend/shop.sale', ['percent' => $product->getSalePercent()]) }}
        </span>
        {{ __('frontend/shop.tags.sale') }}
        <span class="product-tag-old-price">
            <s>{{ $product->getFormattedOldPrice() }}</s>  
        </span>
    </div>
    @endif
                        
    <div class="card-header">
		<div class="stock-header">
			<div class="row">
                <div class="col-xs-12 col-lg-12">
					@if($product->asWeight())
                        <span>
                            {{ __('frontend/shop.amount_with_char', [
                                'amount_with_char' => $product->getWeightAvailable() . $product->getWeightChar()
                            ]) }}
                        </span>
                    @elseif($product->isUnlimited())
                        {{ __('frontend/v4.unlimited_ava') }}
                    @elseif(!$product->asWeight() && !$product->asVariant())
                        {{ __('frontend/v4.stock_ava', [
                            'amount' => $product->getStock()
                        ]) }}
                    @endif	
                    
                    @if($product->getInterval() > 1)
                        <span class="delimiter">|</span> 
                        <span>
                            {{ __('frontend/v4.interval') }} {{ $product->getInterval() }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

		{{ $product->name }}
	</div>

    @if(strlen($product->short_description) > 0)
        <div class="card-body">
        {!! \App\Classes\LangHelper::translate(app()->getLocale(), 'product', 'short_description', 'short_description', $product, true) !!}
        </div>
    @endif

    @if(isset($productShowLongDes) && $productShowLongDes)
        <div class="card-body">
            {!! \App\Classes\LangHelper::translate(app()->getLocale(), 'product', 'description', 'description', $product, true) !!}
        </div>
    @endif
                        
    <ul class="list-group list-group-flush text-right">
        <li class="list-group-item">
            
            <form method="POST" class="mt-15" action="{{ route('buy-product-form') }}">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="product_id" />

                <div class="row">
                    @if($product->asVariant())
                        @php 
                            $variants = $product->getVariants()
                        @endphp
                        <div class="col-xs-7 col-lg-6">
                            <select class="form-control" id="variant_select" required>
                                <option value="">Select Variant</option>
                                @foreach($variants as $variant)
                                <option value="{{$variant->id}}">{{$variant->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-5 col-lg-6 text-start pt-1">
                            <lable class="price-label">Price:<span class="ml-2" id="variant_price" data-price-in-cent=""></span> EUR</label>
                        </div>
                    @else
                        <div class="col-xs-6 col-lg-6 only-p-right">
                            <div class="form-control form-control-round text-left price-control">
                                {{ $product->getFormattedPrice() }}
                            </div>
                        </div>
                        <div class="col-xs-6 col-lg-6">
                            @if(!$product->asWeight() && !$product->isUnlimited())
                                <input type="text" name="product_amount" cart-amount="{{ $product->id }}" class="form-control form-control-round" placeholder="{{ __('frontend/shop.amount_placeholder') }}" @if($product->getStock() == 0) value="{{ __('frontend/shop.sold_out') }}" disabled @endif />
                            @elseif($product->asWeight() || $product->isUnlimited())
                                <input type="text" name="product_amount" cart-amount="{{ $product->id }}" class="form-control form-control-round" placeholder="@if($product->asWeight()){{ __('frontend/shop.weight_placeholder') }}@else{{ __('frontend/shop.amount_placeholder') }}@endif" @if(!$product->isAvailable()) value="{{ __('frontend/shop.sold_out') }}" disabled @endif />
                            @endif
                        </div>
                    @endif
                </div>

                <div class="row mt-15">
                    <!-- <div class="col-xs-6 col-lg-6 mb-15">
                        <button type="submit" class="btn btn-icon btn-block btn-primary @if(!$product->isAvailable()) disabled @endif" @if(!$product->isAvailable()) disabled="true" @endif>{{ __('frontend/v4.buybtn') }}</button>
                    </div> -->
                    <div class="col-xs-12 col-lg-12">
                        @if($product->asVariant())
                        <a href="javascript:;" cart-btn="{{ $product->id }}" onClick="addVariantToCart({{ $product->id }});" class="btn btn-icon btn-block btn-primary @if(!$product->isAvailable()) disabled @endif" @if(!$product->isAvailable()) disabled="true" @endif><ion-icon name="cart"></ion-icon></a>
                        @else
                        <a href="javascript:;" cart-btn="{{ $product->id }}" onClick="addToCart({{ $product->id }}, 'input[cart-amount={{ $product->id }}]');" class="btn btn-icon btn-block btn-primary @if(!$product->isAvailable()) disabled @endif" @if(!$product->isAvailable()) disabled="true" @endif><ion-icon name="cart"></ion-icon></a>
                        @endif
                    </div>
                </div>
            </form>

            <div style="text-align:left;padding-top:10px">
                <b>{{ __('frontend/shop.category') }}</b>
                <a href="{{ route('product-category', [$product->getCategory()->slug]) }}">
                    {{ \App\Classes\LangHelper::translate(app()->getLocale(), 'product', null, 'name', $product->getCategory()) }}   
                </a>
            </div>
            <div style="text-align:left;padding-top:10px">
                <a href="{{ route('product-page', $product->id) }}">{{ __('frontend/shop.details_button') }}</a>
            </div>
        </li>
    </ul>
</div>

@section('page_scripts')
<script type="text/javascript">
	$(function() {
        @if($product->asVariant())
            var variants = [];
            @foreach($variants as $variant)
                variants.push({'id' : {{$variant->id}}, 'price': {{$variant->price}} });
            @endforeach
        @endif

        $("#variant_select").on("change", function(){
            if(!$(this).val()){
                $("#variant_price").html("");
                return;
            }

            const selected_id = $(this).val();
            variants.forEach((item) => {
                if(item.id == selected_id){

                    let formated_price = getFormattedPriceFromCent(item.price);
                    $("#variant_price").attr("data-price-in-cent", item.price).html(formated_price);
                }
            })
                
        })
  	});
</script>
@endsection