<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::get('admin/get-rfid-tag', 'RfidController@getRfidTag')->name('get.rfid.tag');
Route::post('admin/store-rfid', 'RfidController@storeRfid')->name('store.rfid');
Route::get('admin/getAllRFIDTags', 'RfidController@getAllRFIDTags')->name('getAllRFIDTags');



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
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

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    Route::Put('admin/events/{event}/approve', 'EventsController@approve')->name('events.approve');
    Route::Put('admin/events/{event}/refuse', 'EventsController@refuse')->name('events.refuse');
    Route::get('admin/events/deleted', 'EventsController@deletedEvents')->name('events.deleted');


});
