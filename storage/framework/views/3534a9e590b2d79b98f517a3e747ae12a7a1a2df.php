<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <?php if(isset($productCategory) && $productCategory != null && !$productCategoryUncategorized): ?>
        <?php echo $__env->make('meta::manager', [
            'title'         => config('app.name') . ' - ' . $productCategory->name,
            'description'   => $productCategory->meta_tags_desc,
            'keywords'   => $productCategory->keywords
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
        <?php echo $__env->make('meta::manager', [
            'title'         => $metaTITLE ?? config('app.name'),
            'description'   => $metaDESC ?? '',
            'keywords'   => $metaKEYS ?? ''
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet" type="text/css" />

        <link rel="icon" href="<?php if(strlen(App\Models\Setting::get('theme.favicon')) > 0): ?><?php echo e(App\Models\Setting::get('theme.favicon')); ?><?php else: ?><?php echo e(asset_dir('favicon.svg')); ?><?php endif; ?>" sizes="any" />

        <!-- Bootstrap -->
        <link href="<?php echo e(asset_dir('vendor/bootstrap-4.1.3/css/bootstrap.min.css')); ?>" rel="stylesheet" />

        <!-- Styles -->
        <link href="<?php echo e(asset_dir('css/app.css')); ?>" rel="stylesheet" />
        
        <?php if(App\Models\Setting::get('theme.color.enable', 0)): ?>
        <link href="<?php echo e(route('custom-colors')); ?>" rel="stylesheet" />
        <?php endif; ?>

        <?php if(strlen(App\Models\Setting::get('theme.background')) > 0): ?>
        <style type="text/css">
            body {
                background-image: url('<?php echo e(App\Models\Setting::get('theme.background')); ?>');
            }
        </style>
        <?php endif; ?>

        <link href="<?php echo e(asset_dir('css/theme.css')); ?>" rel="stylesheet" />

        <link href="<?php echo e(route('custom-css')); ?>" rel="stylesheet" />

        <!-- Custom CSS -->
		<link href="<?php echo e(asset_dir('css/custom.css')); ?>" rel="stylesheet" type="text/css" />

        <script src="<?php echo e(asset_dir('admin/assets/vendors/general/jquery/dist/jquery.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset_dir('admin/assets/vendors/general/jquery-form/dist/jquery.form.min.js')); ?>" type="text/javascript"></script>

        
    </head>
    <body>
        <div id="app">
            <div class="">
                <div class="">
                    <div class="">
                        <nav class="navbar navbar-expand-lg navbar-light nav-shop nav-log">
                            <div class="container">
                                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                                    <?php if(strlen(App\Models\Setting::get('theme.logo')) > 0): ?>
                                    <img src="<?php echo e(App\Models\Setting::get('theme.logo')); ?>" alt="logo" style="max-width: 200px;" />
                                    <?php else: ?>
                                    <?php echo e(config('app.name')); ?>

                                    <?php endif; ?>
                                </a>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('frontend/main.toggle_navigation')); ?>">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(url('/')); ?>"><?php echo e(__('frontend/main.home')); ?></a>
                                        </li>

                                        <?php
                                            $productCategories = \App\Models\ProductCategory::all()
                                        ?>
                                        <li class="nav-item <?php if(count($productCategories) > 0): ?> dropdown <?php endif; ?>">
                                            <?php if(count($productCategories) > 0 || App\Models\Setting::get('shop.creditcards.enabled')): ?>
                                                <a id="navbarDropdownShop" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    <?php echo e(__('frontend/main.shop')); ?>

                                                </a>
                                            <?php else: ?>
                                                <a class="nav-link" href="<?php echo e(route('shop')); ?>">
                                                    <?php echo e(__('frontend/main.shop')); ?>

                                                </a>
                                            <?php endif; ?>

                                            <?php if(count($productCategories) > 0 || App\Models\Setting::get('shop.creditcards.enabled')): ?>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="<?php echo e(route('shop')); ?>">
                                                    <?php echo e(__('frontend/shop.all_categories')); ?>

                                                </a>

                                                <div class="dropdown-divider"></div>

                                                <?php if(App\Models\Setting::get('shop.creditcards.enabled')): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('creditcards')); ?>">
                                                        <?php echo e(__('frontend/shop.creditcards')); ?>

                                                    </a>

                                                    <?php if(count($productCategories) > 0): ?>
                                                    <div class="dropdown-divider"></div>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(count($productCategories) > 0): ?>
                                                    <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('product-category', [$productCategory->slug])); ?>">
                                                        <?php echo e(\App\Classes\LangHelper::getValue(app()->getLocale(), 'product-category', null, $productCategory->id) ?? $productCategory->name); ?>

                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if(count(App\Models\Product::getUncategorizedProducts())): ?>
                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item" href="<?php echo e(route('product-category', ['uncategorized'])); ?>">
                                                        <?php echo e(__('frontend/shop.uncategorized')); ?>

                                                    </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('faq')); ?>"><?php echo e(__('frontend/main.faq')); ?></a>
                                        </li>

                                        <?php if(auth()->guard()->check()): ?>
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdownShop" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <?php echo e(__('frontend/main.tickets')); ?>

                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="<?php echo e(route('tickets')); ?>">
                                                    <?php echo e(__('frontend/main.my_tickets')); ?>

                                                </a>
                                            
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="<?php echo e(route('ticket-create')); ?>">
                                                    <?php echo e(__('frontend/main.create_ticket')); ?>

                                                </a>
                                            </div>
                                        </li>
                                        <?php endif; ?>
                                    </ul>

                                    <ul class="navbar-nav ml-auto">
                                        <?php if(auth()->guard()->guest()): ?>
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-outline-secondary topnavBtn" href="<?php echo e(route('login')); ?>"><?php echo e(__('frontend/main.login')); ?></a>
                                            </li>
                                            <?php if(Route::has('register')): ?>
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-outline-secondary  topnavBtn" href="<?php echo e(route('register')); ?>"><?php echo e(__('frontend/main.register')); ?></a>
                                            </li>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <li class="nav-item">
                                                <a class="nav-link activated-link btn topnavBtn" href="<?php echo e(route('deposit')); ?>">
                                                    <ion-icon name="wallet"></ion-icon>
                                                    <?php echo e(Auth::user()->getFormattedBalance()); ?>

                                                </a>
                                            </li>
                                        <?php if(auth()->guard()->check()): ?>
                                            <li class="nav-item nonavlnk">
                                                <a href="<?php echo e(route('cart')); ?>" class="nav-link nav-link-btc btn topnavBtn">
                                                    <ion-icon name="cart"></ion-icon>
                                                    <span id="cart-name">
                                                        <?php echo e(\App\Models\UserCart::getCartCountByUserId(\Auth::user()->id)); ?>

                                                    </span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <li class="nav-item active dropdown">
                                            <a id="navbarDropdownUser" class="nav-link dropdown-toggle btn btn-gardient btn-inline-block active " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <ion-icon name="person"></ion-icon>
                                                <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">

                                                <a class="dropdown-item" href="<?php echo e(route('orders')); ?>">
                                                    <?php echo e(__('frontend/user.orders')); ?>

                                                </a>

                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="<?php echo e(route('deposit')); ?>">
                                                    <?php echo e(__('frontend/user.deposit')); ?>

                                                </a>

                                                <a class="dropdown-item" href="<?php echo e(route('transactions')); ?>">
                                                    <?php echo e(__('frontend/user.transactions')); ?>

                                                </a>

                                                

                                                <?php if(Auth::user()->hasPermission('access_backend')): ?>
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="<?php echo e(route('backend-dashboard')); ?>" target="_panel">
                                                    <?php echo e(__('frontend/user.admin_panel')); ?>

                                                    <ion-icon name="open"></ion-icon>
                                                </a>

                                                <div class="dropdown-divider"></div>
                                                <?php endif; ?>

                                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <?php echo e(__('frontend/main.logout')); ?>

                                                </a>
                                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                     
                    </div>
                </div>
            </div>
            
            <main class="py-4">
                <?php if(\Session::has('errorMessage')): ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="<?php echo e(__('frontend/main.close')); ?>">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    <?php echo \Session::get('errorMessage'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(\Session::has('successMessage')): ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="<?php echo e(__('frontend/main.close')); ?>">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    <?php echo \Session::get('successMessage'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span>&copy; 2020 <?php echo e(App\Models\Setting::get('app.name')); ?>. All rights reserved.</span>
                        </div>
                        <div class="col-md-6 text-right mt-15">
                            <a href="#" class="kursbtn">
                                1 BTC = <?php echo e(App\Classes\BitcoinAPI::getFormatted(App\Classes\BitcoinAPI::convertBtc(1))); ?>

                            </a>
                            <?php if(!count(App\Models\Setting::getAvailableLocales())): ?>

                            <?php endif; ?>

                            <?php if(count(App\Models\Setting::getAvailableLocales())): ?> 
                            
                                <?php $__currentLoopData = App\Models\Setting::getAvailableLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="localelink <?php if($locale == app()->getLocale()): ?> localelink-active <?php endif; ?>" href="<?php echo e(route('language', $locale)); ?>">
                                    <img class="flag-icon-img" src="<?php echo e(asset_dir('svg/flags/' . \Lang::get('locale.icon', [], $locale) . '.svg')); ?>" />
                                    <span class="flag-icon-name"><?php echo e(\Lang::get('locale.name', [], $locale)); ?></span>
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        <script src="<?php echo e(asset_dir('vendor/jquery-3.3.1/js/jquery-3.3.1.min.js')); ?>" defer></script>
        <script src="<?php echo e(asset_dir('vendor/bootstrap-4.1.3/js/bootstrap.min.js')); ?>" defer></script>

        <script src="//unpkg.com/ionicons@4.2.2/dist/ionicons.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

        <script type="text/javascript">

            function getFormattedPriceFromCent(cent){
                let price = cent / 100;
                price= price.toLocaleString("de-DE", { maximumFractionDigits: 2, minimumFractionDigits: 2 });
                return price;
            }

            // Need to move some where 
            function updateCart() {
                //$('#cart-name').html('<?php echo e(__('frontend/v4.adding_cart')); ?>');

                $.ajax({
                    'url': '<?php echo e(route('cart-ajax')); ?>',
                    method: 'POST'
                })
                .done(function(response) {
                    $('#cart-name').html(response);
                })
                .fail(function() {
                    $('#cart-name').html('<?php echo e(__('frontend/v4.unknown_error')); ?>');
                });
            }

            function addToCart(productId, amountClass) {
                if(!$('a[cart-btn=' + productId + ']').hasClass('disabled')) {
                    var amount = parseInt($(amountClass).val());
                    $(amountClass).val('');

                    if(amount > 0) {
                        $('a[cart-btn=' + productId + ']').addClass('disabled');

                        $.ajax({
                            'url': '<?php echo e(route('cart-add-item-ajax')); ?>',
                            method: 'POST',
                            data: {product_id:productId, amount:amount}
                        })
                        .done(function(response) {
                            updateCart();

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .fail(function() {
                            alert("Unbekannter Fehler, Seite neuladen.");

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .always(function() {
                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        });
                    }
                }
            }

            function addVariantToCart(productId) {
                if(!$('a[cart-btn=' + productId + ']').hasClass('disabled')) {
                    var selected_variant_id = $("#variant_select").val();
                    var price = parseInt($("#variant_price").attr("data-price-in-cent"));

                    if(selected_variant_id > 0) {
                        $('a[cart-btn=' + productId + ']').addClass('disabled');

                        $.ajax({
                            'url': '<?php echo e(route('cart-add-variant-item-ajax')); ?>',
                            method: 'POST',
                            data: {product_id:productId, selected_variant_id:selected_variant_id, price: price}
                        })
                        .done(function(response) {
                            $("#variant_select").val("").trigger('change');
                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                            updateCart();
                        })
                        .fail(function() {
                            alert("Unbekannter Fehler, Seite neuladen.");

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .always(function() {
                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        });
                    }
                }
            }

            function addTieredProductToCart(productId, amountClass) {
                if(!$('a[cart-btn=' + productId + ']').hasClass('disabled')) {
                    var amount = parseInt($(amountClass).val());
                    const min_amount =  parseInt($(amountClass).attr("min"));
                    if(amount < min_amount){
                        alert("You must purchase at least the minimum order quantity: " + min_amount);
                        return;
                    }
                    $(amountClass).val('');

                    if(amount > 0) {
                        $('a[cart-btn=' + productId + ']').addClass('disabled');

                        $.ajax({
                            'url': '<?php echo e(route('cart-add-tiered-item-ajax')); ?>',
                            method: 'POST',
                            data: {product_id:productId, amount:amount}
                        })
                        .done(function(response) {
                            updateCart();

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .fail(function() {
                            alert("Unbekannter Fehler, Seite neuladen.");

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .always(function() {
                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        });
                    }
                }
            }
            
            <?php if(isset($clipboardJS)): ?>
            var clipboard = new ClipboardJS('<?php echo e($clipboardJS->element); ?>');

            clipboard.on('success', function(e) {
                $('<?php echo e($clipboardJS->fadeIn); ?>').css('display', 'block').hide().fadeIn();
            });
            <?php endif; ?>
        </script>

        <?php $__env->startSection('page_scripts'); ?>
        <?php echo $__env->yieldSection(); ?>
    </body>
</html>
<?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>