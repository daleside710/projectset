<?php

Auth::routes();

Route::get('/auth/redirect/{provider}', 'Auth\SocialController@redirect');
Route::get('/callback/{provider}', 'Auth\SocialController@callback');

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', 'PageController@home')
        ->name('home');

    Route::get('open-box/{boxId}', 'PageController@openBox')->name('openBox');

    Route::get('eboxes', 'PageController@eboxes')
        ->name('eboxes');

    Route::get('faq', 'PageController@faq')
        ->name('faq');

    Route::get('box/details/{boxID}/{boxSlug?}', 'PageController@boxDetails')
        ->name('box-details');

    Route::post('send-contact-email', 'PageController@sendContactEmail')
        ->name('sendContactEmail');

    Route::post('verification', 'PhoneVerificationController@verification')->name('verification');
    Route::get('verificationForm', 'PhoneVerificationController@verificationForm')->name('verificationForm');
    Route::post('resetPassword', 'PhoneVerificationController@resetPassword')->name('resetPassword');
    Route::post('resetForgotPassword', 'PhoneVerificationController@resetForgotPassword')->name('resetForgotPassword');
    Route::post('updatePassword', 'PhoneVerificationController@updatePassword')->name('updatePassword');
    Route::post('resendPhoneVerificationCode', 'PhoneVerificationController@resendPhoneVerificationCode')->name('resendPhoneVerificationCode');
    Route::post('resendPasswordVerificationCode', 'PhoneVerificationController@resendPasswordVerificationCode')->name('resendPasswordVerificationCode');

    Route::group(['middleware' => 'auth'], function () {

        // Ajax Routes
        Route::post('redeem/initiate', 'PageController@initiateRedeem')
            ->name('initiateRedeem');

        Route::post('redeem/spin', 'PageController@spin');

        Route::post('redeem/loadItems', 'PageController@loadItems')	
            ->name('loadItem');	
	
        Route::post('redeem/checkBalance', 'PageController@checkBalance')	
            ->name('checkBalance');

        Route::post('redeem/checkDiscountedCoupon', 'PageController@checkDiscountedCoupon');

        Route::post('redeem/sellBack', 'PageController@sellBack')
            ->name('sellBack');

        // User Routes
        Route::get('account', 'PageController@account')
            ->name('account');

        Route::post('account', 'PageController@updateAccount');

        Route::get('deposit', 'PageController@deposit')
            ->name('deposit');

        Route::get('applyCouponCode', 'PageController@applyCouponCode')
            ->name('applyCouponCode');

        Route::post('deposit', 'PageController@checkout');

        Route::get('redeem/{boxID}', 'PageController@redeem')
            ->name('redeem');

        Route::get('order-this/{productID}', 'PageController@orderItem')
            ->name('order-this');

        Route::get('order-all', 'PageController@getOrderAll')
            ->name('order');

        Route::post('order', 'PageController@createOrder')
            ->name('createOrder');

        Route::get('getCurrentTime', 'PageController@getCurrentTime')
            ->name('getCurrentTime');

        Route::post('update-user-push-id', 'PageController@updateUserPushId')
            ->name('updateUserPushId');

        Route::get('send-notification', 'PageController@sendCurrentUser')
            ->name('notification.send.current');

    });
});

// Backend routes
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'auth'], function () {
    Route::name('admin.')->group(function () {

        Route::get('analytics', 'AnalyticsController@index')
            ->name('analytics.index');

            
        Route::get('products/search', 'ProductController@search')
            ->name('products.search');

        Route::post('products/disable', 'ProductController@disable')
            ->name('products.disable');

        Route::post('products/enable', 'ProductController@enable')
            ->name('products.enable');

        Route::resource('products', 'ProductController');

        Route::get('products/delete/{productID}', 'ProductController@destroy')
            ->name('products.delete');

        Route::resource('boxes', 'BoxController');

        Route::get('boxes/delete/{boxID}', 'BoxController@destroy')
            ->name('boxes.delete');


        Route::get('orders', 'OrderController@index')
            ->name('orders.index');

        Route::get('orders/{orderID}/view', 'OrderController@view')
            ->name('orders.view');

        Route::get('orders/{orderID}/sent', 'OrderController@sent')
            ->name('orders.sent');


        Route::get('faqs/edit', 'FaqController@edit')	
            ->name('faqs.edit');	
    
        Route::post('faqs/edit', 'FaqController@update');


        Route::get('news/edit', 'NewsController@edit')
            ->name('news.edit');

        Route::post('news/edit', 'NewsController@update');


        Route::get('settings', 'PageController@settings')
            ->name('settings');

        Route::get('sms', 'MessageController@createMessage')
            ->name('sms.create');

        Route::post('sms/send', 'MessageController@sendMessage')
            ->name('sms.send');

        Route::post('settings', 'PageController@updateSettings');


        Route::resource('coupons', 'CouponCodeController');
        

        Route::get('newsletter', 'NewsletterController@index')
            ->name('newsletter.index');

        Route::post('newsletter/send', 'NewsletterController@send')
            ->name('newsletter.send');


        Route::get('notification', 'NotificationController@index')
            ->name('notification.index');

        Route::post('notification/send', 'NotificationController@send')
            ->name('notification.send');


        Route::get('mail', 'ContactEmailController@index')
            ->name('mail.index');

        Route::post('send-reply', 'ContactEmailController@sendReply')
            ->name('mail.reply');
    });

});
