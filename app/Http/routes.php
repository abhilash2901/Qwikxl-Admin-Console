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
Route::post('adddepts', 'StoreController@adddepts' );
Route::post('listdepartments', 'StoreController@listdepartments' );
Route::post('departmentedit', 'StoreController@departmentedit' );
Route::post('dptsupdate', 'StoreController@dptsupdate' );
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
Route::get('categorys',  ['uses'=> 'Categorys@index' ,'middleware' => ['permission:add-category']]);
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
Route::get('import',['uses'=>'Products@import','middleware' => ['permission:import']]);
Route::post('dumpproduct', ['uses'=>'Products@dumpproduct','middleware' => ['permission:import']]);
Route::post('changedpt', 'Categorys@changedpt');
Route::post('deletestore', 'Stores@deletestore');
Route::post('deletedpartmt','Stores@deletedpartmt');

Route::post('roleupdate', ['uses'=>'RoleController@roleupdate','middleware' => ['permission:role-edit']]);
Route::post('deleterole', ['uses'=>'RoleController@destroy','middleware' =>['permission:role-delete']]);
Route::post('deleteduser', ['uses'=>'UserController@destroy','middleware' =>['permission:users-delete']]);
Route::post('listingcategory', ['uses'=>'Categorys@listingcategory','middleware' =>['permission:list-category']]);
Route::get('downloadExcel/{type}', 'Products@downloadExcel');
//Route::resource('store', 'stores');
//sooraj
Route::post('changepassed', ['uses' => 'Stores@changepass', 'middleware' => ['permission:storechange-password']]);
Route::post('storeprofiles', ['as' => 'store.update', 'uses' => 'Stores@updates']);
Route::post('state', 'StoreController@state');
Route::post('city', 'StoreController@city');
Route::post('createcity','StoreController@insertcity');
Route::get('listOrders', ['uses' => 'OrdersController@listOrders', 'middleware' => ['permission:order-list']]);
Route::get('listcustomer','OrdersController@listCustomer');
Route::post('getOrders','OrdersController@getOrders');
Route::post('deleteOrder',['uses' => 'OrdersController@deleteOrder', 'middleware' => ['permission:delete-order']]);
Route::post('customerlist','OrdersController@CustomerList');
Route::post('savebanner','BannerController@savebanner');
Route::post('listbanner','BannerController@listbanner');
Route::post('banneredit','BannerController@banneredit');
Route::post('bannerupdate','BannerController@bannerupdate');
Route::post('bannerdelete','BannerController@bannerdelete');
Route::post('getsingleorder','OrdersController@getsingleorder');
Route::get('editorder/{id}',['uses' => 'OrdersController@editOrder', 'middleware' => ['permission:edit-order']]);
Route::post('customupdate','OrdersController@customupdate');
Route::post('updatestatus','OrdersController@updatestatus');

//webservices 
//2

});


Route::post('distanceList', 'GroceryWebservice@distanceList');
Route::post('getStorelist', 'GroceryWebservice@getStorelist');
/*Listing the entire category list of a grocery shop (store)*/
Route::post('getDepartmentList', 'GroceryWebservice@getDepartmentList');
Route::post('getCategoryList', 'GroceryWebservice@getCategoryList');
//Route::get('getCategoryLists', 'GroceryWebservice@getCategoryListss');
//Route::any('getCategoryListtest', 'GroceryWebservice@getCategoryListtest');
//Route::get('getCategoryList/{store_id}/{keyword}', 'GroceryWebservice@getCategoryLists');
/*Listing the Subcategory details according to the grocery store and the category*/

//Route::get('getSubCategoryList/{store_id}/{category_id}/{keyword}', 'GroceryWebservice@getSubCategoryLists');
Route::post('getSubCategoryList', 'GroceryWebservice@getSubCategoryList');
/*Listing the product/inventry list according to the subcategory*/
Route::post('getProductList', 'GroceryWebservice@getProductList');
/*Get the item/product details according to the item/product*/
Route::post('getSingleProduct', 'GroceryWebservice@getSingleProduct');
/*Get the latitude of a city*/
Route::post('getLatitudeCity', 'GroceryWebservice@getLatitudeCity');
/*For Registering a New customer*/
Route::post('customerRegister', 'CustomerWebservice@customerRegister');
/*8.For getting the Login details of a customer*/
Route::post('customerLogin', 'CustomerWebservice@customerLogin');
/*Getting the customer details*/
Route::post('customerDetails', 'CustomerWebservice@customerDetails');
/*10. For updating the customer details*/
Route::post('updateCustomer', 'CustomerWebservice@updateCustomer');
/*11. For updating the Customer Card Details*/
Route::post('updateCreditCard', 'CustomerWebservice@updateCreditCard');
/*12. For updating the customer Password*/
Route::post('updatePassword', 'CustomerWebservice@updatePassword');
/*13. For updating the customer profile image*/
Route::post('customerImage', 'CustomerWebservice@customerImage');
/*14. For forgot password*/
Route::post('sentPassword', 'CustomerWebservice@sentPassword');
/*15. Listing the entire country details*/
Route::post('getCountryList', 'CustomerWebservice@getCountryList');
/*16. Saving the order details in the Database (using Stripe)*/
Route::post('saveOrderDetails', 'OrderWebservice@saveOrderDetails');
/*16. Getting the order details by the user email*/
Route::post('orderDetails', 'OrderWebservice@orderDetails');
/*18. Getting the order details by the order id*/
Route::post('orderData', 'OrderWebservice@orderData');

