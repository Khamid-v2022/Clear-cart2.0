<div class="card card-product card-hover mb-15">
    <?php if($product->isSale()): ?>
    <div class="product-tag product-tag-sale">
        <span class="product-tag-percent">
            <?php echo e(__('frontend/shop.sale', ['percent' => $product->getSalePercent()])); ?>

        </span>
        <?php echo e(__('frontend/shop.tags.sale')); ?>

        <span class="product-tag-old-price">
            <s><?php echo e($product->getFormattedOldPrice()); ?></s>  
        </span>
    </div>
    <?php endif; ?>
                        
    <div class="card-header">
		<div class="stock-header">
			<div class="row">
                <div class="col-xs-12 col-lg-12">
					<?php if($product->asWeight()): ?>
                        <span>
                            <?php echo e(__('frontend/shop.amount_with_char', [
                                'amount_with_char' => $product->getWeightAvailable() . $product->getWeightChar()
                            ])); ?>

                        </span>
                    <?php elseif($product->isUnlimited()): ?>
                        <?php echo e(__('frontend/v4.unlimited_ava')); ?>

                    <?php elseif(!$product->asWeight() && !$product->asVariant() && !$product->asTiered()): ?>
                        <?php echo e(__('frontend/v4.stock_ava', [
                            'amount' => $product->getStock()
                        ])); ?>

                    <?php endif; ?>	
                    
                    <?php if($product->getInterval() > 1): ?>
                        <span class="delimiter">|</span> 
                        <span>
                            <?php echo e(__('frontend/v4.interval')); ?> <?php echo e($product->getInterval()); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

		<?php echo e($product->name); ?>

	</div>

    <?php if($images = $product->getImages()): ?>
    <div class="card-body">
        <div style="text-align:center">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e('/files/' . $image->img_path); ?>" class="product-img">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if(strlen($product->short_description) > 0): ?>
        <div class="card-body">
        <?php echo \App\Classes\LangHelper::translate(app()->getLocale(), 'product', 'short_description', 'short_description', $product, true); ?>

        </div>
    <?php endif; ?>

    <?php if(isset($productShowLongDes) && $productShowLongDes): ?>
        <div class="card-body">
            <?php echo \App\Classes\LangHelper::translate(app()->getLocale(), 'product', 'description', 'description', $product, true); ?>

        </div>
    <?php endif; ?>

    <?php if($product->asTiered()): ?>
        <?php 
            $tiered_prices = $product->getTieredPrices()
        ?>
        <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-transactions table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo e(__('frontend/shop.starting_from')); ?></th>
                                <th scope="col"><?php echo e(__('frontend/shop.price')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tiered_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($price->amount); ?></td>
                                <td> <?php echo e(\App\Models\Product::getFormattedPriceFromCent($price->price)); ?> </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
          
        </div>
    <?php endif; ?>
                        
    <ul class="list-group list-group-flush text-right">
        <li class="list-group-item">
            
            <form method="POST" class="mt-15" action="<?php echo e(route('buy-product-form')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id" />

                <div class="row">
                    <?php if($product->asVariant()): ?>
                        <?php 
                            $variants = $product->getVariants()
                        ?>
                        <div class="col-xs-7 col-lg-6">
                            <select class="form-control" id="variant_select" required>
                                <option value=""><?php echo e(__('frontend/shop.select_variant')); ?></option>
                                <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($variant->id); ?>"><?php echo e($variant->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-xs-5 col-lg-6 text-start pt-1">
                            <lable class="price-label"><?php echo e(__('frontend/shop.price')); ?><span class="ml-2" id="variant_price" data-price-in-cent=""></span> EUR</label>
                        </div>
                    <?php elseif($product->asTiered()): ?>
                        <div class="col-xs-7 col-lg-6 d-flex">
                            <button type="button" class="btn" id="decrease_amount_btn">-</button>
                            <input type="number" id="product_amount_tiered" name="product_amount"  cart-amount="<?php echo e($product->id); ?>" class="form-control form-control-round" min="<?php echo e($tiered_prices[0]->amount); ?>" value="<?php echo e($tiered_prices[0]->amount); ?>"> 
                            <button type="button" class="btn" id="increase_amount_btn">+</button>
                        </div>
                        <div class="col-xs-5 col-lg-6 text-start pt-1">
                            <lable class="price-label">Price:<span class="ml-2" id="product_price" data-price-in-cent=""></span> EUR</label>
                        </div>
                    <?php else: ?>
                        <div class="col-xs-6 col-lg-6 only-p-right">
                            <div class="form-control form-control-round text-left price-control">
                                <?php echo e($product->getFormattedPrice()); ?>

                            </div>
                        </div>
                        <div class="col-xs-6 col-lg-6">
                            <?php if(!$product->asWeight() && !$product->isUnlimited()): ?>
                                <input type="text" name="product_amount" cart-amount="<?php echo e($product->id); ?>" class="form-control form-control-round" placeholder="<?php echo e(__('frontend/shop.amount_placeholder')); ?>" <?php if($product->getStock() == 0): ?> value="<?php echo e(__('frontend/shop.sold_out')); ?>" disabled <?php endif; ?> />
                            <?php elseif($product->asWeight() || $product->isUnlimited()): ?>
                                <input type="text" name="product_amount" cart-amount="<?php echo e($product->id); ?>" class="form-control form-control-round" placeholder="<?php if($product->asWeight()): ?><?php echo e(__('frontend/shop.weight_placeholder')); ?><?php else: ?><?php echo e(__('frontend/shop.amount_placeholder')); ?><?php endif; ?>" <?php if(!$product->isAvailable()): ?> value="<?php echo e(__('frontend/shop.sold_out')); ?>" disabled <?php endif; ?> />
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row mt-15">
                    <div class="col-xs-12 col-lg-12">
                        <?php if($product->asVariant()): ?>
                            <a href="javascript:;" cart-btn="<?php echo e($product->id); ?>" onClick="addVariantToCart(<?php echo e($product->id); ?>);" class="btn btn-icon btn-block btn-primary <?php if(!$product->isAvailable()): ?> disabled <?php endif; ?>" <?php if(!$product->isAvailable()): ?> disabled="true" <?php endif; ?>><ion-icon name="cart"></ion-icon></a>
                        <?php elseif($product->asTiered()): ?>
                            <a href="javascript:;" cart-btn="<?php echo e($product->id); ?>" onClick="addTieredProductToCart(<?php echo e($product->id); ?>, 'input[cart-amount=<?php echo e($product->id); ?>]');" class="btn btn-icon btn-block btn-primary <?php if(!$product->isAvailable()): ?> disabled <?php endif; ?>" <?php if(!$product->isAvailable()): ?> disabled="true" <?php endif; ?>><ion-icon name="cart"></ion-icon></a>
                        <?php else: ?>
                            <a href="javascript:;" cart-btn="<?php echo e($product->id); ?>" onClick="addToCart(<?php echo e($product->id); ?>, 'input[cart-amount=<?php echo e($product->id); ?>]');" class="btn btn-icon btn-block btn-primary <?php if(!$product->isAvailable()): ?> disabled <?php endif; ?>" <?php if(!$product->isAvailable()): ?> disabled="true" <?php endif; ?>><ion-icon name="cart"></ion-icon></a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

            <div style="text-align:left;padding-top:10px">
                <b><?php echo e(__('frontend/shop.category')); ?></b>
                <a href="<?php echo e(route('product-category', [$product->getCategory()->slug])); ?>">
                    <?php echo e(\App\Classes\LangHelper::translate(app()->getLocale(), 'product', null, 'name', $product->getCategory())); ?>   
                </a>
            </div>
            <div style="text-align:left;padding-top:10px">
                <a href="<?php echo e(route('product-page', $product->id)); ?>"><?php echo e(__('frontend/shop.details_button')); ?></a>
            </div>
        </li>
    </ul>
</div>

<?php $__env->startSection('page_scripts'); ?>
<script type="text/javascript">
	$(function() {
        <?php if($product->asVariant()): ?>
            var variants = [];
            <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                variants.push({'id' : <?php echo e($variant->id); ?>, 'price': <?php echo e($variant->price); ?> });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if($product->asTiered()): ?>
            var tiered_prices = [];
            <?php $__currentLoopData = $tiered_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                tiered_prices.push({'amount' : <?php echo e($price->amount); ?>, 'price': <?php echo e($price->price); ?> });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>


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

        $("#product_amount_tiered").on("keyup", function(){
            const amount = parseInt($(this).val());
            const min_value = parseInt($("#product_amount_tiered").attr("min"));

            if(amount){
                if(tiered_prices.length > 0){
                    // sort by amount
                    tiered_prices = tiered_prices.sort((a, b) => b.amount - a.amount);

                    for(let i = 0; i < tiered_prices.length; i++){
                        if(amount >= tiered_prices[i].amount){
                            let total_price = tiered_prices[i].price * amount;
                            let formated_price = getFormattedPriceFromCent(total_price);
                            $("#product_price").attr("data-price-in-cent", total_price).html(formated_price);
                            return;
                        }
                    }
                    let total_price = tiered_prices[tiered_prices.length - 1].price * amount;
                    let formated_price = getFormattedPriceFromCent(total_price);
                    $("#product_price").attr("data-price-in-cent", total_price).html(formated_price);
                }
            } else {
                $("#product_price").attr("data-price-in-cent", "").html("");
            }
           
        })

        $("#decrease_amount_btn").on("click", function(){
            let amount = parseInt($("#product_amount_tiered").val());

            const min_value = parseInt($("#product_amount_tiered").attr("min"));
            if(amount > 0 && amount > min_value){
                amount--;
                $("#product_amount_tiered").val(amount).trigger("keyup");
            }
        })

        $("#increase_amount_btn").on("click", function(){
            let amount = parseInt($("#product_amount_tiered").val());

            amount++;
            $("#product_amount_tiered").val(amount).trigger("keyup");
        })

        $("#product_amount_tiered").trigger("keyup");
  	});
</script>
<?php $__env->stopSection(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/product_card.blade.php ENDPATH**/ ?>