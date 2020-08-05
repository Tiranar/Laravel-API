<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/malarkey', function (Request $request) {
//     return "malarkey";
// });

Route::resource('actions', 'ActionsAPIController');
Route::resource('applications', 'ApplicationAPIController');
Route::resource('auth_tokens', 'AuthTokenAPIController');
Route::resource('devices', 'DeviceAPIController');
Route::resource('events', 'EventAPIController');
Route::resource('groups', 'GroupAPIController');
Route::resource('organizations', 'OrganizationAPIController');
Route::resource('promotions', 'PromotionAPIController');
Route::resource('receipts', 'ReceiptAPIController');
Route::resource('users', 'UserAPIController');

Route::resource('group_users', 'GroupUserAPIController');
Route::resource('organization_users', 'OrganizationUserAPIController');
Route::resource('organization_applications', 'OrganizationApplicationAPIController');
Route::resource('organization_groups', 'OrganizationGroupAPIController');

// Equipment route

Route::get('/user/{userId}/equipment', 'EquipmentAPIController@getUserEquipment')
    ->name('Equipment.getEquipment');


Route::post('/user/{userId}/equipment/add/{itemId}/{slotId}', 'EquipmentAPIController@addItem')
    ->name('Equipment.addEquipment');

Route::post('/user/{userId}/equipment/remove/{itemId}/{slotId}', 'EquipmentAPIController@removeItem')
    ->name('Equipment.removeEquipment');

//Inventory route

Route::get('/user/{userId}/inventory/{type?}', 'InventoryAPIController@getUserItems')
    ->name('inventory.getInventory');


Route::post('/user/{userId}/inventory/add/{itemId}', 'InventoryAPIController@addItem')
    ->name('inventory.addItem');

Route::post('/user/{userId}/inventory/remove/{itemId}', 'InventoryAPIController@removeItem')
    ->name('inventory.removeItem');


Route::group(['prefix' => 'groups'], function () {

    //OMG this is a terrible route
    Route::get('/of/users/{user}', 'UserAPIController@groups');

    Route::get('/{group}/users', 'GroupAPIController@users');
    Route::get('/{group}/leaders', 'GroupAPIController@leaders');
    Route::get('/{group}/members', 'GroupAPIController@members');

    Route::post('/{groupId}/add/{userId}', 'GroupAPIController@addUserToGroup');
    Route::post('/{groupId}/remove/{userId}', 'GroupAPIController@removeUserFromGroup');


});

//Coins route
Route::get('/user/{userId}/coins', 'CoinsAPIController@getCoins')
        ->name('coins.getCoins');

Route::post('/user/{userId}/coins/add/{amount}', 'CoinsAPIController@addCoins')
        ->where('amount', '[0-9]+')
        ->name('coins.addCoins');

Route::post('/user/{userId}/coins/remove/{amount}', 'CoinsAPIController@removeCoins')
        ->where('amount', '[0-9]+')
        ->name('coins.removeCoins');


Route::post('/sync', 'OrganizationAPIController@sync');
Route::get('/receipts', 'OrganizationAPIController@receipts');
Route::post('/receipts/validate/apple', 'ReceiptAPIController@validateApple');
Route::post('/receipts/validate/android', 'ReceiptAPIController@validateAndroid');

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'OrganizationAPIController@login');
    Route::post('/users/{email}/password/reset/confirm', 'OrganizationAPIController@resetPasswordConfirm');
    Route::post('/users/{email}/password/reset', 'OrganizationAPIController@resetPassword');
});

Route::group(['prefix' => 'items'], function () {

    Route::get('{type}/type', 'ItemsAPIController@getByType');
    Route::get('{item_id}', 'ItemsAPIController@getById');

});
