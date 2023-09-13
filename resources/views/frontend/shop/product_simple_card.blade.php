<a href="{{ route('product-page', $product->id) }}" style="text-decoration: none;">
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
                        @elseif(!$product->asWeight() && !$product->asVariant()  && !$product->asTiered())
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
                
                <div style="text-align:left;padding-top:10px">
                    <b>{{ __('frontend/shop.price') }}</b>
                    {{ $product->getBasePrice() }}
                </div>
            </li>
        </ul>
    </div>
</a>