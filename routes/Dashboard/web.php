<?php   
// App::bind('App\Billing\Stripe', function(){
// 	return new \App\Billing\Stripe(config('services.stripe.secret'));
// });

// $stripe = resolve('App\Billing\Stripe');

// dd($stripe);

// App::bind('App\Billing\Stripe', function(){
// 	return new \App\Billing\Stripe(config('services.stripe.secret'));
// });

// $stripe = resolve('App\Billing\Stripe');

// dd($stripe);

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
	{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
 

	    Route::prefix('dashboard')->name('dashboard.')->group(function(){
	    Route::get('/','WelcomeController@index')->name('welcome');


		//category routes
		Route::resource('/categories', 'CategoriesController')->except(['show']);

		//product routes
		Route::resource('/products', 'ProductsController')->except(['show']);

		 //client routes
		Route::resource('clients', 'ClientsController')->except(['show']);
		Route::resource('clients.orders', 'Client\OrdersController')->except(['show']);
		
		 


		// Orders Controller
		Route::resource('/orders', 'OrdersController')->except(['show']);
		// Route::get('/orders', 'OrdersController@index')->name('orders');
		Route::get('/orders/{order}/products', 'OrdersController@products')->name('orders.products');

		//user routes
		Route::resource('users', 'UserController');

		
	});
	
});

