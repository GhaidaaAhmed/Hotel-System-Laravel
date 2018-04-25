<?php
//Auth Route
Auth::routes();



//Home Route
Route::get('/', 'HomeController@index');

//Payment Route
Route::get('/reservations/checkout', 'CheckoutController@checkout');
Route::post('/reservations/payment', 'CheckoutController@payment');

//Clients Route

Route::get('/users', 'UsersController@index')->name('usersList');
Route::get('/users/show/{id}', 'UsersController@show')->name('usersShow');
Route::get('/users/edit/{id}', 'UsersController@edit')->name('usersEdit');
Route::post('/users/create/{id}', 'UsersController@create')->name('usersCreate');
Route::put('/users/update/{id}', 'UsersController@update')->name('usersUpdate');
Route::delete('/users/delete/{id}', 'UsersController@destroy')->name('usersdelete');

// managers routes
Route::get('/managers', 'Admins\Managers\ManagerController@index')->name('managerList')->where('role','superadmin');
Route::get('/managers/create', 'Admins\Managers\ManagerController@create')->name('managerCreate');
Route::post('/managers', 'Admins\Managers\ManagerController@store');
Route::get('/managers/{id}', 'Admins\Managers\ManagerController@show')->name('managerShow');
Route::get('/managers/{id}/edit', 'Admins\Managers\ManagerController@edit')->name('managerEdit');
Route::put('/managers/{id}', 'Admins\Managers\ManagerController@update')->name('managerUpdate');
Route::delete('/managers/{id}', 'Admins\Managers\ManagerController@destroy')->name('managerdelete');
Route::get('datatable', 'Admins\Managers\ManagerController@datatable');
//receptionists routes
Route::get('/receptionists', 'Admins\Receptionists\ReceptionistController@index')->name('receptionistList');
Route::get('/receptionists/create', 'Admins\Receptionists\ReceptionistController@create')->name('receptionistCreate');
Route::post('/receptionists', 'Admins\Receptionists\ReceptionistController@store');
Route::get('/receptionists/{id}', 'Admins\Receptionists\ReceptionistController@show')->name('receptionistShow');
Route::get('/receptionists/{id}/edit', 'Admins\Receptionists\ReceptionistController@edit')->name('receptionistEdit');
Route::put('/receptionists/{id}', 'Admins\Receptionists\ReceptionistController@update')->name('receptionistUpdate');
Route::delete('/receptionists/{id}', 'Admins\Receptionists\ReceptionistControllerr@destroy')->name('receptionistdelete');
Route::get('data', 'Admins\Receptionists\ReceptionistController@datatable');
Route::get('/receptionists/{id}/ban', 'Admins\Receptionists\ReceptionistController@ban');
Route::get('/receptionists/{id}/unban', 'Admins\Receptionists\ReceptionistController@unban');




//admin routes
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'Admins\AdminController@index')->middleware('forbid-banned-admin')->name('admin.dashboard');

});

//floors 

Route::get('/floors', 'FloorsController@index');
Route::get('/floors/create', 'FloorsController@create');
Route::post('/floors/store/{floor_number}', 'FloorsController@store');
Route::get('/floors/edit/{id}', 'FloorsController@edit');
Route::put('/floors/update/{id}', 'FloorsController@update');
Route::delete('floors/delete/{id}','FloorsController@destroy');
Route::get('floors/datatable', 'FloorsController@datatable')->name('floors');

//Managing Rooms Routes
Route::get('/rooms', 'RoomController@index')->name('rooms.index');
Route::get('/rooms/edit/{id}', 'RoomController@edit');
Route::get('/rooms/create', 'RoomController@create');
Route::post('/rooms','RoomController@store');
Route::put('/rooms/update/{id}', 'RoomController@update');
Route::delete('/rooms/delete/{id}', 'RoomController@destroy');

//reservations routes
Route::get('/client', 'ReservationsController@index')->name('reservation.index');
Route::get('/reservations/freeRooms', 'ReservationsController@freeRooms');
Route::get('/reservations/rooms/{room_id}','ReservationsController@create');
Route::post('/reservations/store/{id}','ReservationsController@store');
