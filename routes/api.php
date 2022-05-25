<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Plan
    Route::apiResource('plans', 'PlanApiController');

    // House
    Route::post('houses/media', 'HouseApiController@storeMedia')->name('houses.storeMedia');
    Route::apiResource('houses', 'HouseApiController');

    // Loaction
    Route::apiResource('loactions', 'LoactionApiController');

    // Amenity
    Route::apiResource('amenities', 'AmenityApiController');

    // House Gallery
    Route::post('house-galleries/media', 'HouseGalleryApiController@storeMedia')->name('house-galleries.storeMedia');
    Route::apiResource('house-galleries', 'HouseGalleryApiController');

    // Car
    Route::post('cars/media', 'CarApiController@storeMedia')->name('cars.storeMedia');
    Route::apiResource('cars', 'CarApiController');

    // Vehicle Info
    Route::apiResource('vehicle-infos', 'VehicleInfoApiController');

    // Land Or Plot
    Route::post('land-or-plots/media', 'LandOrPlotApiController@storeMedia')->name('land-or-plots.storeMedia');
    Route::apiResource('land-or-plots', 'LandOrPlotApiController');

    // Electronic
    Route::post('electronics/media', 'ElectronicApiController@storeMedia')->name('electronics.storeMedia');
    Route::apiResource('electronics', 'ElectronicApiController');

    // Subscription
    Route::apiResource('subscriptions', 'SubscriptionApiController');

    // Advert
    Route::post('adverts/media', 'AdvertApiController@storeMedia')->name('adverts.storeMedia');
    Route::apiResource('adverts', 'AdvertApiController');
});
