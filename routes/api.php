<?php

    //\URL::forceScheme('https');

    use Illuminate\Http\Request;

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::group(['prefix' => 'api', 'middleware' => 'api'], function() {
    //     Route::post('btcpay/webhook', 'API\BTCWebhook');
    // });