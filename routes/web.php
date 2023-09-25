<?php

    // \URL::forceScheme('https');

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\App\DefaultController;
    use App\Http\Controllers\App\LanguageController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\Custom\CSSController;
    use App\Http\Controllers\Error\ErrorController;
    use App\Http\Controllers\FAQ\FAQController;
    use App\Http\Controllers\Livewire\FrontEnd\Chat\ChatDashbaord;
    use App\Http\Controllers\Livewire\FrontEnd\TicketList;
    use App\Http\Controllers\RobotsController;
    use App\Http\Controllers\Shop\CartController;
    use App\Http\Controllers\Shop\CreditCardsController;
    use App\Http\Controllers\Shop\ShopController;
    use App\Http\Controllers\SitemapController;
    use App\Http\Controllers\UserPanel\TicketController;
    use App\Http\Controllers\UserPanel\UserPanelController;
    use Rap2hpoutre\LaravelLogViewer\LogViewerController;
    
    Route::get('/robots.txt', [RobotsController::class, 'robots'])->name('robots');
    Route::get('/sitemap', [SitemapController::class, 'main'])->name('sitemap');
    Route::get('/sitemap/products', [SitemapController::class, 'products'])->name('sitemap-products');
    Route::get('/sitemap/categories', [SitemapController::class, 'categories'])->name('sitemap-categories');
    Route::get('/sitemap/news', [SitemapController::class, 'news'])->name('sitemap-news');
    Route::get('/sitemap.xml', [SitemapController::class, 'main'])->name('sitemap-xml');
    
    /*
     * Error
     */

    Route::get('403', [ErrorController::class, 'forbidden']);
    Route::get('404', [ErrorController::class, 'notFound']);
    Route::get('500', [ErrorController::class, 'fatal']);
    Route::get('503', [ErrorController::class, 'serviceUnavailable']);
    Route::get('no-permissions', [ErrorController::class, 'noPermissions'])->name('no-permissions');
     
    /*
    Route::get('/api/product/database/import', 'API\ProductDatabaseImportController@databaseImport')->name('api-product-database-import');
    Route::post('/api/product/database/import', 'API\ProductDatabaseImportController@databaseImport');

    Route::get('/api/product/database/lbl/import', 'API\ProductDatabaseImportController@databaseImportLineByLine')->name('api-product-database-line-by-line-import');
    Route::post('/api/product/database/lbl/import', 'API\ProductDatabaseImportController@databaseImportLineByLine');

    Route::get('/api/product/database/seperator/import', 'API\ProductDatabaseImportController@databaseImportSeperator')->name('api-product-database-seperator-import');
    Route::post('/api/product/database/seperator/import', 'API\ProductDatabaseImportController@databaseImportSeperator');

    Route::get('/api/bitcoin/info', 'API\BitcoinWalletController@bitcoinWalletInfo')->name('api-bitcoin-wallet-info');
    Route::post('/api/bitcoin/info', 'API\BitcoinWalletController@bitcoinWalletInfo');
     */

    Route::get('/custom/css', [CSSController::class, 'generateCustomCSS'])->name('custom-css');
    Route::get('/custom/colors', [CSSController::class, 'generateOverridingColorsCSS'])->name('custom-colors');
     
    // Default
    Route::get('/', [DefaultController::class, 'showIndex'])->name('index');
    Route::get('/article/{id}', [DefaultController::class, 'showArticle'])->name('article');
    Route::get('/page/{page?}', [DefaultController::class, 'showIndex'])->name('index-with-pageNumber');
     
    // Auth
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
     
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    /*
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    */

    Route::group(["middleware" => 'auth'], function () {
        Route::get('home', [UserPanelController::class, 'showUserDashboard'])->name('home');

        Route::get('coupon/remove/checkout', [UserPanelController::class, 'removeCouponCheckout'])->name('remove-coupon-checkout');
        Route::post('coupon/redeem/checkout', [UserPanelController::class, 'redeemCouponCheckout'])->name('redeem-coupon-checkout');
        Route::post('coupon/redeem', [UserPanelController::class, 'redeemCoupon'])->name('redeem-coupon');

        // No longer use
        // Route::get('settings', 'UserPanel\UserPanelController@showSettingsPage')->name('settings');

        // Route::get('settings/password/change', function () {
        //     return redirect()->route('settings');
        // });

        // Route::post('settings/password/change', 'UserPanel\UserPanelController@passwordChangeForm')->name('settings-password-change');

        // Route::get('settings/jabber-id/change', function () {
        //     return redirect()->route('settings');
        // });

        // Route::post('settings/jabber-id/change', 'UserPanel\UserPanelController@jabberIDChangeForm')->name('settings-jabber-id-change');

        // Route::get('settings/mail-address/change', function () {
        //     return redirect()->route('settings');
        // });

        // Route::post('settings/mail-address/change', 'UserPanel\UserPanelController@mailAddressChangeForm')->name('settings-mail-address-change');

        Route::get('deposit', [UserPanelController::class, 'showDepositPage'])->name('deposit');
        Route::post('deposit-btc', [UserPanelController::class, 'showDepositBtcPage'])->name('deposit-btc');
        Route::post('deposit-btc/{id}', [UserPanelController::class, 'depositBtcPaidCheck'])->name('deposit-btc-post');
        Route::get('deposit-eth', [UserPanelController::class, 'showDepositEthPage'])->name('deposit-eth');
        Route::post('deposit-eth/{id}', [UserPanelController::class, 'depositEthPaidCheck'])->name('deposit-eth-post');

        
        Route::get('orders', [UserPanelController::class, 'showOrdersPage'])->name('orders');
        Route::get('orders/page/{page?}', [UserPanelController::class, 'showOrdersPage'])->name('orders-with-pageNumber');
        Route::get('order-details/{id}', [UserPanelController::class, 'showOrdersDetailPage'])->name('order-detail-page');


        Route::get('tickets', [TicketController::class, 'showTicketsPage'])->name('tickets');
        Route::get('tickets/page/{page?}', [TicketController::class, 'showTicketsPage'])->name('tickets-with-pageNumber');

        Route::get('tickets_new', TicketList::class)->name('tickets_new');

        Route::prefix('ticket')->group(function () {
            Route::get('create', [TicketController::class, 'showTicketCreatePage'])->name('ticket-create');
            Route::post('create', [TicketController::class, 'showTicketCreatePage'])->name('ticket-create-form');
            Route::get('delete/{id}', [TicketController::class, 'deleteTicket'])->name('ticket-delete');
            Route::post('reply/{id}', [TicketController::class, 'replyTicket'])->name('ticket-reply');
            Route::get('{id}', [TicketController::class, 'showTicketPage'])->name('ticket-id');
        });

        Route::get('transactions', [UserPanelController::class, 'showTransactionsPage'])->name('transactions');
        Route::get('transactions/page/{page?}', [UserPanelController::class, 'showTransactionsPage'])->name('transactions-with-pageNumber');

        // FAQ
        Route::get('faq', [FAQController::class, 'showFAQPage'])->name('faq');

        // Language
        Route::get('language/{lang}', [LanguageController::class, 'setLanguage'])->name('language');

        // Shop
        Route::get('shop', [ShopController::class, 'showShopPage'])->name('shop');

        Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('checkout', [CartController::class, 'checkoutSubmit'])->name('checkout-form');

        Route::get('cart', [CartController::class, 'show'])->name('cart');
        Route::get('cart/remove/{id?}', [CartController::class, 'delete'])->name('cart-item-delete');
        Route::get('cart/clear', [CartController::class, 'clear'])->name('cart-clear');
        Route::post('ajax/cart/add', [CartController::class, 'ajaxAddItem'])->name('cart-add-item-ajax');
        Route::post('ajax/cart/add-variant', [CartController::class, 'ajaxAddVariantItem'])->name('cart-add-variant-item-ajax');
        Route::post('ajax/cart/add-tiered-item', [CartController::class, 'ajaxAddTieredItem'])->name('cart-add-tiered-item-ajax');
        Route::post('ajax/cart', [CartController::class, 'cart'])->name('cart-ajax');
    

        Route::get('product/buy/{id?}/{amount?}', [ShopController::class, 'buyProductForm'])->name('buy-product');
        Route::post('product/buy', [ShopController::class, 'buyProductForm'])->name('buy-product-form');
        Route::post('product/buy-confirm', [ShopController::class, 'buyProductConfirmForm'])->name('buy-product-form-confirm');

        Route::get('product/category/{slug}', [ShopController::class, 'showProductCategoryPage'])->name('product-category');

        Route::get('product/{id}', [ShopController::class, 'showProductPage'])->name('product-page');

        Route::get('creditcards', [CreditCardsController::class, 'showCreditCardsPage'])->name('creditcards');
        Route::get('creditcards/page/{page?}', [CreditCardsController::class, 'showCreditCardsPage'])->name('creditcards-with-pageNumber');

        Route::group(["middleware" => 'user'], function () {
            Route::get('chat', ChatDashbaord::class)->name('chat.dashboard');
        });
    });

    Route::view('chat_demo', 'chat_demo')->name('chat_demo');

    Route::get('logs', [LogViewerController::class, 'index']);

    // backend route
    include __DIR__ . '/admin.php';
    