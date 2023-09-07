<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
		    <form method="POST" action="<?php echo e(route('buy-product-form-confirm')); ?>">
                <h3 class="page-title"><?php echo e(__('frontend/shop.product_confirm_buy')); ?></h3>
                
                <?php if(!$product->dropNeeded()): ?>
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/shop.start_video_alert')); ?>

                </div>
                <?php endif; ?>

                <div class="card mb-15">
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

                    <div class="card-header"><?php echo e($product->name); ?></div>

                    <?php if(strlen($product->short_description) > 0): ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?php echo nl2br(decrypt($product->short_description)); ?>

                        </li>
                    </ul>
                    <?php endif; ?>

                    <?php if(strlen($product->description) > 0): ?>
                    <div class="card-body">
                        <?php echo nl2br(decrypt($product->description)); ?>

                    </div>
                    <?php endif; ?>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b><?php echo e(__('frontend/shop.category')); ?></b>
                            <a href="<?php echo e(route('product-category', [$product->getCategory()->slug])); ?>">
                                <?php echo e($product->getCategory()->name); ?>

                            </a>
                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b><?php echo e(__('frontend/shop.price')); ?></b> <?php echo e($product->getFormattedPrice()); ?>

                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?php if(!$product->asWeight()): ?>
                            <b><?php echo e(__('frontend/shop.product_amount')); ?></b> <?php echo e($amount); ?>

                            <?php else: ?>
                            <b><?php echo e(__('frontend/shop.product_weight')); ?></b> <?php echo e($amount); ?><?php echo e($product->getWeightChar()); ?>

                            <?php endif; ?>
                        </li>
                    </ul>
<?php if(isset($bonus) && $bonus != null): ?>
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <b>Bonus:</b> <?php echo e($bonus); ?>

    </li>
</ul>
<?php endif; ?>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b><?php echo e(__('frontend/shop.total_price')); ?></b> <?php echo e($totalPrice); ?>

                        </li>
                    </ul>

                    <?php if($product->dropNeeded()): ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b><?php echo e(__('frontend/shop.delivery_method.title')); ?></b><br /><br />

                            <?php $__currentLoopData = App\Models\DeliveryMethod::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="k-radio k-radio--all k-radio--solid">
								<input type="radio" name="product_delivery_method" value="<?php echo e($deliveryMethod->id); ?>" data-content-visible="false" data-weight-visible="false" <?php if(!$deliveryMethod->isAvailableAmount($totalPriceInCent)): ?> disabled <?php endif; ?> />
							    <span></span>
								<?php echo e(__('frontend/shop.delivery_method.row', [
                                    'name' => $deliveryMethod->name,
                                    'price' => $deliveryMethod->getFormattedPrice()
                                ])); ?>

                               
                                <?php if(!$deliveryMethod->isAvailableAmount($totalPriceInCent)): ?>)
                                <div class="delivery-method-info">
                                    <?php echo e(__('frontend/shop.delivery_method.minmaxinfo', [
                                        'min' => $deliveryMethod->getFormattedMinAmount(),
                                        'max' => $deliveryMethod->getFormattedMaxAmount()
                                    ])); ?>

                                </div>
                                <?php endif; ?>
							</label><br />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label for="product_drop"><?php echo e(__('frontend/shop.order_note')); ?></label>
                            <textarea class="form-control" name="product_drop" id="product_drop" placeholder="<?php echo e(__('frontend/shop.order_note_placeholder')); ?>"><?php echo e(old('product_drop') ?? \Session::get('productDrop') ?? ''); ?></textarea>
                        </li>
                    </ul>
                    <?php endif; ?>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="text-right">
                                 <?php echo csrf_field(); ?>
                                        
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" />
                                <input type="hidden" name="product_amount" value="<?php echo e($amount); ?>" />
                                <a href="<?php echo e(route('product-page', $product->id)); ?>" class="btn btn-outline-secondary"><?php echo e(__('frontend/shop.cancel_order')); ?></a>
                                <button class="btn btn-primary" <?php if(!$product->isAvailable()): ?> disabled <?php endif; ?>><?php echo e(__('frontend/shop.confirm')); ?></button>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($replaceEntry) && $replaceEntry != null): ?>
<hr />
            
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo e(__('frontend/shop.replace_rules_alert')); ?>

            </div>
        </div>
    </div>
</div>

<div id="faqAccordion" class="mb-15 accordion-with-icon">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-15">
                <div class="card">
                    <div class="card-header" id="faqHeading">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-block text-left text-decoration-none" data-toggle="collapse" data-target="#faqCollapse" aria-expanded="true" aria-controls="faqCollapse">
                                <strong class="text-dark">1.</strong> <?php echo e($replaceEntry->question); ?>

                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse" class="collapse show" aria-labelledby="faqHeading" data-parent="#faqAccordion">
                        <div class="card-body">
                            <?php echo strlen($replaceEntry->answer) > 0 ? decrypt(nl2br($replaceEntry->answer)) : ''; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/product_confirm_buy.blade.php ENDPATH**/ ?>