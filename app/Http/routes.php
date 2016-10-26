<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
 
Route::get('/', function () {
    return view('welcome');
});


Route::auth();
Route::get('/login', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function() {
Route::get('/home', 'HomeController@index');
//Route::resource('users','UserController');
Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => ['permission:users-list']]);
Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => ['permission:users-create']]);
Route::post('users/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => ['permission:users-create']]);
Route::get('users/{id}',['as'=>'users.show','uses'=>'UserController@show']);
Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => ['permission:users-edit']]);
Route::delete('users/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => ['permission:users-delete']]);

Route::patch('users/{id}',['as'=>'users.update','uses'=>'UserController@update','middleware' => ['permission:users-edit']]);
	


Route::get('stores', 'UserController@storess');
Route::post('type', 'UserController@getroles');
Route::post('createuser', 'UserController@createusers');
Route::post('createuserstore', 'StoreController@createuserstore');
Route::get('addstore', ['uses'=>'StoreController@createstore','middleware' => ['permission:add-stores']]  );
Route::get('findstore', ['uses'=>'StoreController@findstore','middleware' => ['permission:find-stores']] );
Route::get('autocomplete', 'StoreController@autocomplete');
Route::get('autocompletes', 'StoreController@autocompletes');
Route::resource('liststore', 'StoreController@liststore');

Route::post('deleteuser', 'StoreController@deleteusers' );
Route::post('liststoreusers', 'StoreController@liststoreusers' );
Route::post('storedetails', 'StoreController@storedetails' );
Route::post('changepass', ['uses'=>'UserController@changepass','middleware' => ['permission:change-password']]);
Route::post('getuserdetails', 'StoreController@getuserdetails' );
Route::post('edituser', 'StoreController@edituser' );
Route::post('adddept', 'StoreController@adddept' );
Route::post('editdept',  'StoreController@editdept');
Route::post('storecreate', 'StoreController@create' );
Route::post('storeedit', 'StoreController@storeedit' );
Route::get('editstore', ['uses'=>'StoreController@editstore','middleware' => ['permission:edit-stores']]  );
Route::post('selectstore', 'StoreController@selectstores' );
Route::post('updatesprofile', ['uses'=>'RoleController@updates','middleware' => ['permission:profile-view']] );
Route::post('addstore/create', ['as'=>'store.create','uses'=>'StoreController@create'] );

	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
	Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
	Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
	Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
	Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
	Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
	Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);
	Route::get('profile/{id}',['uses'=>'UserController@showprofile','middleware' => ['permission:profile-view']]);
//storeusers
Route::get('storeprofile',['uses'=>'Stores@index','middleware' => ['permission:store-profile']] );
Route::post('liststoreuser',  ['uses'=>'Stores@liststoreuser','middleware' => ['permission:storeuser-list']]);
Route::post('editstoredata',['uses'=> 'Stores@editstoredata','middleware' => ['permission:editstore-details']]);
Route::post('addcategory', ['uses'=> 'Categorys@addcategory','middleware' => ['permission:add-category']]);
Route::post('liststoresuser', 'Stores@liststoresuser');
Route::get('storelistss', ['uses'=> 'Stores@storelists','middleware' => ['permission:store-profile']]);
Route::get('category',  ['uses'=> 'Categorys@index' ,'middleware' => ['permission:add-category']]);
Route::get('categorylist',  ['uses'=> 'Categorys@categorylist' ,'middleware' => ['permission:list-category']]);
Route::get('editcategory/{id}',  ['uses'=> 'Categorys@editcategory' ,'middleware' => ['permission:edit-category']]);
Route::post('editscategorylist', 'Categorys@editscategorylist');
Route::post('deletecategory', ['uses'=> 'Categorys@deletecategory' ,'middleware' => ['permission:delete-category']]);
Route::get('addproduct',  ['uses'=> 'Products@index' ,'middleware' => ['permission:add-product']]);
Route::get('listproduct', ['uses'=> 'Products@listproduct' ,'middleware' => ['permission:list-product']]);
Route::post('saveproduct', ['uses'=> 'Products@saveproduct' ,'middleware' => ['permission:add-product']]);
Route::post('updateproduct', ['uses'=> 'Products@updateproduct' ,'middleware' => ['permission:edit-product']]);
Route::post('removepic', 'Products@removepic');
Route::get('editproduct/{id}', ['uses'=> 'Products@editproduct' ,'middleware' => ['permission:edit-product']]);
Route::post('deleteproduct', ['uses'=> 'Products@deleteproduct','middleware' => ['permission:delete-product']]);
Route::post('selectcategory', 'Categorys@selectcategory');
Route::post('getdepatments', 'Products@getdepatments');
Route::post('listingproducts', 'Products@listingproducts');
Route::get('import',['uses'=>'Products@import'] );
Route::post('dumpproduct', 'Products@dumpproduct');
Route::post('changedpt', 'Categorys@changedpt');
//Route::resource('store', 'stores');
//sooraj
Route::post('changepassed', ['uses' => 'Stores@changepass', 'middleware' => ['permission:storechange-password']]);
Route::post('storeprofiles', ['as' => 'store.update', 'uses' => 'Stores@updates',]);
Route::post('state', 'StoreController@state');
Route::post('city', 'StoreController@city');
Route::post('createcity','StoreController@insertcity');
});

