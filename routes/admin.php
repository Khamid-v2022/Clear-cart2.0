<?php

use App\Http\Controllers\Backend\API\JSONController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DesignController;
use App\Http\Controllers\Backend\JabberController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\LogoutController;
use App\Http\Controllers\Backend\Management\ArticlesController;
use App\Http\Controllers\Backend\Management\CouponsController;
use App\Http\Controllers\Backend\Management\DeliveryMethodsController;
use App\Http\Controllers\Backend\Management\FAQsCategoriesController;
use App\Http\Controllers\Backend\Management\FAQsController;
use App\Http\Controllers\Backend\Management\ProductsCategoriesController;
use App\Http\Controllers\Backend\Management\ProductsController;
use App\Http\Controllers\Backend\Management\TicketsCategoriesController;
use App\Http\Controllers\Backend\Management\TicketsController;
use App\Http\Controllers\Backend\Management\UsersController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\NotificationsController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\ShoppingsController;
use App\Http\Controllers\Backend\System\BonusController;
use App\Http\Controllers\Backend\System\PaymentsController;
use App\Http\Controllers\Backend\System\SettingsController;
use App\Http\Controllers\Livewire\BackEnd\Chat\ChatDashbaord;
use App\Http\Controllers\Livewire\BackEnd\TicketList;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', function () {
        return redirect()->route('backend-login');
    });

    // Login & Logout
    Route::get('login', [LoginController::class, 'showLoginPage'])->name('backend-login');
    Route::post('login', [LoginController::class, 'login'])->name('backend-login-form');

    // Route::group(["middleware" => ['auth', 'admin']], function () {

        Route::post('logout', [LogoutController::class, 'logout'])->name('backend-logout');
        Route::get('logout', [LogoutController::class, 'logout'])->name('backend-logout');

        // Dashboard
        Route::get('admin', [DashboardController::class, 'showDashboard'])->name('backend-dashboard');
        Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('backend-dashboard');

        // System Settings - No longer Use
        Route::get('system/settings', [SettingsController::class, 'showSettings'])->name('backend-system-settings');
        Route::post('system/settings', [SettingsController::class, 'showSettings'])->name('backend-system-settings-form');

        // // System Bonus - No longer Use
        // Route::get('system/bonus', [BonusController::class, 'show'])->name('backend-system-bonus');
        // Route::post('system/bonus', [BonusController::class, 'show'])->name('backend-system-bonus-form');
        // Route::get('system/bonus/del/{id}', [BonusController::class, 'delete'])->name('backend-system-bonus-del');

        // // Design - No longer Use
        // Route::get('design', [DesignController::class, 'page'])->name('backend-design');
        // Route::post('design', [DesignController::class, 'page'])->name('backend-design-form');

        // // Media - No longer Use
        // Route::post('media/upload', [MediaController::class, 'upload'])->name('backend-media-upload');
        // Route::get('media', [MediaController::class, 'page'])->name('backend-media');
        // Route::get('media/page/{page?}', [MediaController::class, 'page'])->name('backend-media-with-pageNumber');
        // Route::get('media/delete/{id}', [MediaController::class, 'delete'])->name('backend-media-delete');

        // System Payments - No longer Use
        Route::get('system/payments', [PaymentsController::class, 'showPayments'])->name('backend-system-payments');
        Route::post('system/payments', [PaymentsController::class, 'showPayments'])->name('backend-system-payments-form');

        // Bitcoin Wallet
        Route::get('bitcoin', [Bitcoin\DashboardController::class, 'showDashboardPage'])->name('backend-bitcoin-dashboard');
        Route::get('bitcoin/page/{page?}', [Bitcoin\DashboardController::class, 'showDashboardPage'])->name('backend-bitcoin-dashboard-with-pageNumber');
        Route::post('bitcoin/sendbtc', [Bitcoin\DashboardController::class, 'sendBtcForm'])->name('backend-bitcoin-sendbtc-form');
        Route::post('bitcoin/primarywallet', [Bitcoin\DashboardController::class, 'setPrimaryWalletForm'])->name('backend-bitcoin-primarywallet-form');

        // // Jabber --- No longer Use
        // Route::get('jabber', [JabberController::class, 'showJabberPage'])->name('backend-jabber');
        // Route::post('jabber/newsletter', [JabberController::class, 'sendNewsletter'])->name('backend-jabber-newsletter-form');
        // Route::post('jabber/login', [JabberController::class, 'loginSave'])->name('backend-jabber-login-form');

        // Orders
        Route::post('orders/add-note/{id}', [OrdersController::class, 'addNote'])->name('backend-orders-add-note-form');
        Route::get('orders/cancel/{id}', [OrdersController::class, 'cancelOrder'])->name('backend-order-cancel');
        Route::get('orders/complete/{id}', [OrdersController::class, 'completeOrder'])->name('backend-order-complete');
        Route::get('orders/delete/{id}', [OrdersController::class, 'deleteOrder'])->name('backend-order-delete');
        Route::get('orders/id/{id}', [OrdersController::class, 'showOrder'])->name('backend-order-id');
        Route::get('orders', [OrdersController::class, 'showOrdersPage'])->name('backend-orders');
        Route::get('orders/page/{page?}', [OrdersController::class, 'showOrdersPage'])->name('backend-orders-with-pageNumber');

        Route::get('shopping/id/{id}/done', [ShoppingsController::class, 'done'])->name('backend-shopping-done');
        Route::get('shopping/id/{id}', [ShoppingsController::class, 'showShopping'])->name('backend-shopping-id');
        Route::get('shoppings', [ShoppingsController::class, 'show'])->name('backend-shoppings');
        Route::get('shoppings/page/{page?}', [ShoppingsController::class, 'show'])->name('backend-shoppings-with-pageNumber');

        Route::prefix('management')->group(function () {
            // Product Categories
            Route::get('products/category/delete/{id}', [ProductsCategoriesController::class, 'deleteProductCategory'])->name('backend-management-product-category-delete');
            Route::get('products/categories', [ProductsCategoriesController::class, 'showProductsCategoriesPage'])->name('backend-management-products-categories');
            Route::get('products/categories/page/{page?}', [ProductsCategoriesController::class, 'showProductsCategoriesPage'])->name('backend-management-products-categories-with-pageNumber');
            Route::get('products/categories/add', [ProductsCategoriesController::class, 'showProductCategoryAddPage'])->name('backend-management-product-category-add');
            Route::post('products/categories/add', [ProductsCategoriesController::class, 'addProductCategoryForm'])->name('backend-management-product-category-add-form');
            Route::any('products/categories/lang/{lang}/edit/{id}', [ProductsCategoriesController::class, 'showProductCategoryEditPageLang'])->name('lang-edit-product-category');
            Route::get('products/categories/edit/{id}', [ProductsCategoriesController::class, 'showProductCategoryEditPage'])->name('backend-management-product-category-edit');
            Route::post('products/categories/edit', [ProductsCategoriesController::class, 'editProductCategoryForm'])->name('backend-management-product-category-edit-form');

            // Products
            Route::get('product/bonus/{id}', [ProductsController::class, 'showProductBonusPage'])->name('backend-management-product-bonus');
            Route::post('product/bonus/{id}', [ProductsController::class, 'showProductBonusPage'])->name('backend-management-product-bonus-form');
            Route::get('product/bonus/{id}/del/{bid}', [ProductsController::class, 'deleteBonus'])->name('backend-management-product-bonus-del');

            Route::get('product/database/{id}', [ProductsController::class, 'showProductDatabasePage'])->name('backend-management-product-database');
            Route::get('product/database/{id}/page/{page?}', [ProductsController::class, 'showProductDatabasePage'])->name('backend-management-product-database-with-pageNumber');
            Route::get('product/database/search/{id}', [ProductsController::class, 'showProductDatabasePageSearch'])->name('backend-management-product-database-search');
            Route::post('product/database/search/{id}', [ProductsController::class, 'showProductDatabasePageSearch'])->name('backend-management-product-database-search');
            Route::get('product/database/search/{id}/page/{page?}', [ProductsController::class, 'showProductDatabasePageSearch'])->name('backend-management-product-database-search-with-pageNumber');
            Route::get('product/database/delete/{id}', [ProductsController::class, 'deleteProductItem'])->name('backend-management-product-database-delete');
            Route::get('product/database/edit/{id}', [ProductsController::class, 'editProductItem'])->name('backend-management-product-database-edit');
            Route::post('product/database/edit/{id}', [ProductsController::class, 'editProductItem'])->name('backend-management-product-database-edit-form');
            Route::post('product/database/import/txt', [ProductsController::class, 'databaseImportTXT'])->name('backend-management-product-database-import-txt');
            Route::post('product/database/import/one', [ProductsController::class, 'databaseImportONE'])->name('backend-management-product-database-import-one');
            Route::get('product/delete/{id}', [ProductsController::class, 'deleteProduct'])->name('backend-management-product-delete');
            Route::get('products/add', [ProductsController::class, 'showProductAddPage'])->name('backend-management-product-add');
            Route::post('products/add', [ProductsController::class, 'addProductForm'])->name('backend-management-product-add-form');
            Route::any('products/lang/{lang}/edit/{id}', [ProductsController::class, 'showProductEditPageLang'])->name('lang-edit-product');
            Route::get('products/edit/{id}', [ProductsController::class, 'showProductEditPage'])->name('backend-management-product-edit');
            Route::post('products/edit', [ProductsController::class, 'editProductForm'])->name('backend-management-product-edit-form');
            Route::get('products', [ProductsController::class, 'showProductsPage'])->name('backend-management-products');
            Route::get('products/page/{page?}', [ProductsController::class, 'showProductsPage'])->name('backend-management-products-with-pageNumber');

            /*
            Route::get('creditcards',CreditCardsController::class,'showCreditCardsPage'])->name('backend-management-creditcards');
            Route::get('creditcards/page/{page?}',CreditCardsController::class,'showCreditCardsPage'])->name('backend-management-creditcards-with-pageNumber');
             */

            // Ticket Categories
            Route::any('tickets/category/lang/{lang}/edit/{id}', [TicketsCategoriesController::class, 'showTicketCategoryEditPageLang'])->name('lang-edit-ticket-category');
            Route::get('tickets/category/delete/{id}', [TicketsCategoriesController::class, 'deleteTicketCategory'])->name('backend-management-ticket-category-delete');
            Route::get('tickets/categories', [TicketsCategoriesController::class, 'showTicketsCategoriesPage'])->name('backend-management-tickets-categories');
            Route::get('tickets/categories/page/{page?}', [TicketsCategoriesController::class, 'showTicketsCategoriesPage'])->name('backend-management-tickets-categories-with-pageNumber');
            Route::get('tickets/categories/add', [TicketsCategoriesController::class, 'showTicketCategoryAddPage'])->name('backend-management-ticket-category-add');
            Route::post('tickets/categories/add', [TicketsCategoriesController::class, 'addTicketCategoryForm'])->name('backend-management-ticket-category-add-form');
            Route::get('tickets/categories/edit/{id}', [TicketsCategoriesController::class, 'showTicketCategoryEditPage'])->name('backend-management-ticket-category-edit');
            Route::post('tickets/categories/edit', [TicketsCategoriesController::class, 'editTicketCategoryForm'])->name('backend-management-ticket-category-edit-form');

            // Tickets
            Route::get('ticket/delete/{id}', [TicketsController::class, 'deleteTicket'])->name('backend-management-ticket-delete');
            Route::get('ticket/edit/{id}', [TicketsController::class, 'showTicketEditPage'])->name('backend-management-ticket-edit');
            Route::get('ticket/close/{id}', [TicketsController::class, 'closeTicket'])->name('backend-management-ticket-close');
            Route::get('ticket/open/{id}', [TicketsController::class, 'openTicket'])->name('backend-management-ticket-open');
            Route::post('ticket/reply', [TicketsController::class, 'replyTicketForm'])->name('backend-management-ticket-reply-form');
            Route::post('ticket/move-category', [TicketsController::class, 'moveTicketForm'])->name('backend-management-ticket-move-form');
            Route::get('tickets', [TicketsController::class, 'showTicketsPage'])->name('backend-management-tickets');
            Route::get('tickets/page/{page?}', [TicketsController::class, 'showTicketsPage'])->name('backend-management-tickets-with-pageNumber');

            Route::get('tickets_new', TicketList::class)->name('admin.tickets_new');
            Route::get('chat/{userTicketId?}', ChatDashbaord::class)->name('admin.chat.dashbaord');

            // // FAQ Categories
            // Route::any('faqs/categories/lang/{lang}/edit/{id}', [FAQsCategoriesController::class, 'showFAQCategoryEditPageLang'])->name('lang-edit-faq-category');

            // Route::get('faqs/category/delete/{id}', [FAQsCategoriesController::class, 'deleteFAQCategory'])->name('backend-management-faq-category-delete');
            // Route::get('faqs/categories', [FAQsCategoriesController::class, 'showFAQsCategoriesPage'])->name('backend-management-faqs-categories');
            // Route::get('faqs/categories/page/{page?}', [FAQsCategoriesController::class, 'showFAQsCategoriesPage'])->name('backend-management-faqs-categories-with-pageNumber');
            // Route::get('faqs/categories/add', [FAQsCategoriesController::class, 'showFAQCategoryAddPage'])->name('backend-management-faq-category-add');
            // Route::post('faqs/categories/add', [FAQsCategoriesController::class, 'addFAQCategoryForm'])->name('backend-management-faq-category-add-form');
            // Route::get('faqs/categories/edit/{id}', [FAQsCategoriesController::class, 'showFAQCategoryEditPage'])->name('backend-management-faq-category-edit');
            // Route::post('faqs/categories/edit', [FAQsCategoriesController::class, 'editFAQCategoryForm'])->name('backend-management-faq-category-edit-form');

            // FAQ
            Route::any('faq/lang/{lang}/edit/{id}', [FAQsController::class, 'showFAQEditPageLang'])->name('lang-edit-faq');

            Route::get('faq/delete/{id}', [FAQsController::class, 'deleteFAQ'])->name('backend-management-faq-delete');
            Route::get('faq/edit/{id}', [FAQsController::class, 'showFAQEditPage'])->name('backend-management-faq-edit');
            Route::post('faq/edit', [FAQsController::class, 'editFAQForm'])->name('backend-management-faq-edit-form');
            Route::get('faq/add', [FAQsController::class, 'showFAQAddPage'])->name('backend-management-faq-add');
            Route::post('faq/add', [FAQsController::class, 'addFAQForm'])->name('backend-management-faq-add-form');
            Route::get('faqs', [FAQsController::class, 'showFAQsPage'])->name('backend-management-faqs');
            Route::get('faqs/page/{page?}', [FAQsController::class, 'showFAQsPage'])->name('backend-management-faqs-with-pageNumber');

            // Articles
            Route::get('article/delete/{id}', [ArticlesController::class, 'deleteArticle'])->name('backend-management-article-delete');
            Route::any('article/lang/{lang}/edit/{id}', [ArticlesController::class, 'showArticleEditPageLang'])->name('lang-edit-article');
            Route::get('article/edit/{id}', [ArticlesController::class, 'showArticleEditPage'])->name('backend-management-article-edit');
            Route::post('article/edit', [ArticlesController::class, 'editArticleForm'])->name('backend-management-article-edit-form');
            Route::get('article/add', [ArticlesController::class, 'showArticleAddPage'])->name('backend-management-article-add');
            Route::post('article/add', [ArticlesController::class, 'addArticleForm'])->name('backend-management-article-add-form');
            Route::get('articles', [ArticlesController::class, 'showArticlesPage'])->name('backend-management-articles');
            Route::get('articles/page/{page?}', [ArticlesController::class, 'showArticlesPage'])->name('backend-management-articles-with-pageNumber');

            // Users
            Route::get('user/login/{id}', [UsersController::class, 'loginAsUser'])->name('backend-management-user-login');
            Route::get('user/delete/{id}', [UsersController::class, 'deleteUser'])->name('backend-management-user-delete');
            Route::get('user/edit/{id}', [UsersController::class, 'showUserEditPage'])->name('backend-management-user-edit');
            Route::get('user/tickets/{id}', [UsersController::class, 'showTickets'])->name('backend-management-user-tickets');
            Route::get('user/tickets/{id}/page/{page?}', [UsersController::class, 'showTickets'])->name('backend-management-user-tickets-with-pageNumber');
            Route::get('user/orders/{id}', [UsersController::class, 'showOrders'])->name('backend-management-user-orders');
            Route::get('user/orders/{id}/page/{page?}', [UsersController::class, 'showOrders'])->name('backend-management-user-orders-with-pageNumber');
            Route::post('user/update/permissions', [UsersController::class, 'updateUserPermissionsForm'])->name('backend-management-user-update-permissions-form');
            Route::post('user/edit', [UsersController::class, 'editUserForm'])->name('backend-management-user-edit-form');
            Route::get('users', [UsersController::class, 'showUsersPage'])->name('backend-management-users');
            Route::get('users/page/{page?}', [UsersController::class, 'showUsersPage'])->name('backend-management-users-with-pageNumber');

            // Coupons
            Route::get('coupon/delete/{id}', [CouponsController::class, 'deleteCoupon'])->name('backend-management-coupon-delete');
            Route::get('coupon/edit/{id}', [CouponsController::class, 'showCouponEditPage'])->name('backend-management-coupon-edit');
            Route::post('coupon/edit', [CouponsController::class, 'editCouponForm'])->name('backend-management-coupon-edit-form');
            Route::get('coupon/add', [CouponsController::class, 'showCouponAddPage'])->name('backend-management-coupon-add');
            Route::post('coupon/add', [CouponsController::class, 'addCouponForm'])->name('backend-management-coupon-add-form');
            Route::get('coupons', [CouponsController::class, 'showCouponsPage'])->name('backend-management-coupons');
            Route::get('coupons/page/{page?}', [CouponsController::class, 'showCouponsPage'])->name('backend-management-coupons-with-pageNumber');

            // DeliveryMethods
            Route::get('delivery-method/delete/{id}', [DeliveryMethodsController::class, 'deleteDeliveryMethod'])->name('backend-management-delivery-method-delete');
            Route::get('delivery-method/edit/{id}', [DeliveryMethodsController::class, 'showDeliveryMethodEditPage'])->name('backend-management-delivery-method-edit');
            Route::post('delivery-method/edit', [DeliveryMethodsController::class, 'editDeliveryMethodForm'])->name('backend-management-delivery-method-edit-form');
            Route::get('delivery-method/add', [DeliveryMethodsController::class, 'showDeliveryMethodAddPage'])->name('backend-management-delivery-method-add');
            Route::post('delivery-method/add', [DeliveryMethodsController::class, 'addDeliveryMethodForm'])->name('backend-management-delivery-method-add-form');
            Route::get('delivery-methods', [DeliveryMethodsController::class, 'showDeliveryMethodsPage'])->name('backend-management-delivery-methods');
            Route::get('delivery-methods/page/{page?}', [DeliveryMethodsController::class, 'showDeliveryMethodsPage'])->name('backend-management-delivery-methods-with-pageNumber');
        });

        // User Orders
        Route::get('user/{userid}/orders/cancel/{id}', [OrdersController::class, 'cancelUserOrder'])->name('backend-user-order-cancel');
        Route::get('user/{userid}/orders/complete/{id}', [OrdersController::class, 'completeUserOrder'])->name('backend-user-order-complete');
        Route::get('user/{userid}/orders/delete/{id}', [OrdersController::class, 'deleteUserOrder'])->name('backend-user-order-delete');

        // Notifications
        Route::get('notifications/clear', [NotificationsController::class, 'deleteAllNotifications'])->name('backend-notifications-clear');
        Route::get('notification/delete/{id}', [NotificationsController::class, 'deleteNotification'])->name('backend-notification-delete');
        Route::get('notifications', [NotificationsController::class, 'showNotificationsPage'])->name('backend-notifications');
        Route::get('notifications/page/{page?}', [NotificationsController::class, 'showNotificationsPage'])->name('backend-notifications-with-pageNumber');

        // JSON
        Route::post('api/recent-orders', [JSONController::class, 'getRecentOrders'])->name('backend-api-recent-orders');
        Route::get('api/recent-orders', [JSONController::class, 'getRecentOrders'])->name('backend-api-recent-orders');

        Route::post('api/recent-tickets', [JSONController::class, 'getRecentTickets'])->name('backend-api-recent-tickets');
        Route::get('api/recent-tickets', [JSONController::class, 'getRecentTickets'])->name('backend-api-recent-tickets');

        Route::get('api/notifications', [JSONController::class, 'getNotifications'])->name('backend-api-notifications');
    // });
});
