<a href="<?php echo e(route('product-page', $product->id)); ?>" style="text-decoration: none;">
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

                        <?php elseif(!$product->asWeight() && !$product->asVariant()  && !$product->asTiered()): ?>
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
                            
        <ul class="list-group list-group-flush text-right">
            <li class="list-group-item">
                
                <div style="text-align:left;padding-top:10px">
                    <b><?php echo e(__('frontend/shop.price')); ?></b>
                    <?php echo e($product->getBasePrice()); ?>

                </div>
            </li>
        </ul>
    </div>
</a><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/product_simple_card.blade.php ENDPATH**/ ?>