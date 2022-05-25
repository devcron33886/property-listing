<?php

Route::view('/', 'welcome');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Plan
    Route::delete('plans/destroy', 'PlanController@massDestroy')->name('plans.massDestroy');
    Route::resource('plans', 'PlanController');

    // House
    Route::delete('houses/destroy', 'HouseController@massDestroy')->name('houses.massDestroy');
    Route::post('houses/media', 'HouseController@storeMedia')->name('houses.storeMedia');
    Route::post('houses/ckmedia', 'HouseController@storeCKEditorImages')->name('houses.storeCKEditorImages');
    Route::resource('houses', 'HouseController');

    // Location
    Route::delete('loactions/destroy', 'LoactionController@massDestroy')->name('loactions.massDestroy');
    Route::resource('loactions', 'LoactionController');

    // Amenity
    Route::delete('amenities/destroy', 'AmenityController@massDestroy')->name('amenities.massDestroy');
    Route::resource('amenities', 'AmenityController');

    // House Gallery
    Route::delete('house-galleries/destroy', 'HouseGalleryController@massDestroy')->name('house-galleries.massDestroy');
    Route::post('house-galleries/media', 'HouseGalleryController@storeMedia')->name('house-galleries.storeMedia');
    Route::post('house-galleries/ckmedia', 'HouseGalleryController@storeCKEditorImages')->name('house-galleries.storeCKEditorImages');
    Route::resource('house-galleries', 'HouseGalleryController');

    // Car
    Route::delete('cars/destroy', 'CarController@massDestroy')->name('cars.massDestroy');
    Route::post('cars/media', 'CarController@storeMedia')->name('cars.storeMedia');
    Route::post('cars/ckmedia', 'CarController@storeCKEditorImages')->name('cars.storeCKEditorImages');
    Route::resource('cars', 'CarController');

    // Vehicle Info
    Route::delete('vehicle-infos/destroy', 'VehicleInfoController@massDestroy')->name('vehicle-infos.massDestroy');
    Route::resource('vehicle-infos', 'VehicleInfoController');

    // Car Media
    Route::delete('car-media/destroy', 'CarMediaController@massDestroy')->name('car-media.massDestroy');
    Route::post('car-media/media', 'CarMediaController@storeMedia')->name('car-media.storeMedia');
    Route::post('car-media/ckmedia', 'CarMediaController@storeCKEditorImages')->name('car-media.storeCKEditorImages');
    Route::resource('car-media', 'CarMediaController');

    // Land Or Plot
    Route::delete('land-or-plots/destroy', 'LandOrPlotController@massDestroy')->name('land-or-plots.massDestroy');
    Route::post('land-or-plots/media', 'LandOrPlotController@storeMedia')->name('land-or-plots.storeMedia');
    Route::post('land-or-plots/ckmedia', 'LandOrPlotController@storeCKEditorImages')->name('land-or-plots.storeCKEditorImages');
    Route::resource('land-or-plots', 'LandOrPlotController');

    // Land Media
    Route::delete('land-media/destroy', 'LandMediaController@massDestroy')->name('land-media.massDestroy');
    Route::post('land-media/media', 'LandMediaController@storeMedia')->name('land-media.storeMedia');
    Route::post('land-media/ckmedia', 'LandMediaController@storeCKEditorImages')->name('land-media.storeCKEditorImages');
    Route::resource('land-media', 'LandMediaController');

    // Electronic
    Route::delete('electronics/destroy', 'ElectronicController@massDestroy')->name('electronics.massDestroy');
    Route::post('electronics/media', 'ElectronicController@storeMedia')->name('electronics.storeMedia');
    Route::post('electronics/ckmedia', 'ElectronicController@storeCKEditorImages')->name('electronics.storeCKEditorImages');
    Route::resource('electronics', 'ElectronicController');

    // Subscription
    Route::delete('subscriptions/destroy', 'SubscriptionController@massDestroy')->name('subscriptions.massDestroy');
    Route::resource('subscriptions', 'SubscriptionController');

    // Advert
    Route::delete('adverts/destroy', 'AdvertController@massDestroy')->name('adverts.massDestroy');
    Route::post('adverts/media', 'AdvertController@storeMedia')->name('adverts.storeMedia');
    Route::post('adverts/ckmedia', 'AdvertController@storeCKEditorImages')->name('adverts.storeCKEditorImages');
    Route::resource('adverts', 'AdvertController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Plan
    Route::delete('plans/destroy', 'PlanController@massDestroy')->name('plans.massDestroy');
    Route::resource('plans', 'PlanController');

    // House
    Route::delete('houses/destroy', 'HouseController@massDestroy')->name('houses.massDestroy');
    Route::post('houses/media', 'HouseController@storeMedia')->name('houses.storeMedia');
    Route::post('houses/ckmedia', 'HouseController@storeCKEditorImages')->name('houses.storeCKEditorImages');
    Route::resource('houses', 'HouseController');

    // Location
    Route::delete('loactions/destroy', 'LoactionController@massDestroy')->name('loactions.massDestroy');
    Route::resource('loactions', 'LoactionController');

    // Amenity
    Route::delete('amenities/destroy', 'AmenityController@massDestroy')->name('amenities.massDestroy');
    Route::resource('amenities', 'AmenityController');

    // House Gallery
    Route::delete('house-galleries/destroy', 'HouseGalleryController@massDestroy')->name('house-galleries.massDestroy');
    Route::post('house-galleries/media', 'HouseGalleryController@storeMedia')->name('house-galleries.storeMedia');
    Route::post('house-galleries/ckmedia', 'HouseGalleryController@storeCKEditorImages')->name('house-galleries.storeCKEditorImages');
    Route::resource('house-galleries', 'HouseGalleryController');

    // Car
    Route::delete('cars/destroy', 'CarController@massDestroy')->name('cars.massDestroy');
    Route::post('cars/media', 'CarController@storeMedia')->name('cars.storeMedia');
    Route::post('cars/ckmedia', 'CarController@storeCKEditorImages')->name('cars.storeCKEditorImages');
    Route::resource('cars', 'CarController');

    // Vehicle Info
    Route::delete('vehicle-infos/destroy', 'VehicleInfoController@massDestroy')->name('vehicle-infos.massDestroy');
    Route::resource('vehicle-infos', 'VehicleInfoController');

    // Car Media
    Route::delete('car-media/destroy', 'CarMediaController@massDestroy')->name('car-media.massDestroy');
    Route::post('car-media/media', 'CarMediaController@storeMedia')->name('car-media.storeMedia');
    Route::post('car-media/ckmedia', 'CarMediaController@storeCKEditorImages')->name('car-media.storeCKEditorImages');
    Route::resource('car-media', 'CarMediaController');

    // Land Or Plot
    Route::delete('land-or-plots/destroy', 'LandOrPlotController@massDestroy')->name('land-or-plots.massDestroy');
    Route::post('land-or-plots/media', 'LandOrPlotController@storeMedia')->name('land-or-plots.storeMedia');
    Route::post('land-or-plots/ckmedia', 'LandOrPlotController@storeCKEditorImages')->name('land-or-plots.storeCKEditorImages');
    Route::resource('land-or-plots', 'LandOrPlotController');

    // Land Media
    Route::delete('land-media/destroy', 'LandMediaController@massDestroy')->name('land-media.massDestroy');
    Route::post('land-media/media', 'LandMediaController@storeMedia')->name('land-media.storeMedia');
    Route::post('land-media/ckmedia', 'LandMediaController@storeCKEditorImages')->name('land-media.storeCKEditorImages');
    Route::resource('land-media', 'LandMediaController');

    // Electronic
    Route::delete('electronics/destroy', 'ElectronicController@massDestroy')->name('electronics.massDestroy');
    Route::post('electronics/media', 'ElectronicController@storeMedia')->name('electronics.storeMedia');
    Route::post('electronics/ckmedia', 'ElectronicController@storeCKEditorImages')->name('electronics.storeCKEditorImages');
    Route::resource('electronics', 'ElectronicController');

    // Subscription
    Route::delete('subscriptions/destroy', 'SubscriptionController@massDestroy')->name('subscriptions.massDestroy');
    Route::resource('subscriptions', 'SubscriptionController');

    // Advert
    Route::delete('adverts/destroy', 'AdvertController@massDestroy')->name('adverts.massDestroy');
    Route::post('adverts/media', 'AdvertController@storeMedia')->name('adverts.storeMedia');
    Route::post('adverts/ckmedia', 'AdvertController@storeCKEditorImages')->name('adverts.storeCKEditorImages');
    Route::resource('adverts', 'AdvertController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
