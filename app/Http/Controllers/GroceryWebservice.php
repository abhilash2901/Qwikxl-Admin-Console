<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Role;
use App\Departments;
use DB;
use Session;
use App\Category;
use App\Product;
use App\Banner;
use App\Store;
use input;
use App\Http\Requests;
use Hash;

class GroceryWebservice extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function distanceList(Request $request) {
		$input = $request->all();
		
		
		$store = Store::get();
		
        if(count($store)>0){
			$data = array("Status"=>'true',"StoreDetails"=>$store); 
		}else{
			$data = array("Status"=>'false',"StoreDetails"=>$store ); 
		}
        print_r(json_encode($data));


	} public function getCategoryList(Request $request) {
		$input = $request->all();
		if(isset($input['keyword'])){
			$categories = Category::select('id','categoryname','image')->where("store_id",$input['store_id'])->where('categoryname', 'like', '%' .$input['keyword'] . '%')->get();
		}else{
			$categories = Category::select('id','categoryname','image')->where("store_id",$input['store_id'])->get();
		
		}
		$banner=Banner::select('image')->where("store_id",$input['store_id'])->limit(3)->get();
		
        if(count($categories)>0){
			$data = array("Status"=>'true',"categoryDetails"=>$categories ,"banners"=>$banner); 
		}else{
			$data = array("Status"=>'false',"categoryDetails"=>$categories ); 
		}
        print_r(json_encode($data));


	} public function getCategoryListtest(Request $request) {
		//$id=Request::post('store_id');
		//$postInput = file_get_contents('php://input');
//$datas = json_decode($postInput, true);
          $input = $request->all();
       // $id = $input['store_id'];

		
		$categories = Category::select('id','store_id','parent_id','categoryname','image')->get();
		
        if(count($categories)>0){
			$data = array("Status"=>'true',"categoryDetails"=>$categories ); 
		}else{
			$data = array("Status"=>'false',"categoryDetails"=>$categories ); 
		}
        print_r(json_encode($input));


	}  public function getSubCategoryList(Request $request) {
		$input = $request->all();
		if(isset($input['keyword'])){
			$categories = Category::select('id', 'categoryname','image')->where("store_id",$input['store_id'])->where("parent_id",$input['category_id'])->where('categoryname', 'like', '%' . $input['keyword'] . '%')->get();
		   
		}else{
			$categories = Category::select('id', 'categoryname','image')->where("store_id",$input['store_id'])->where("parent_id",$input['category_id'])->get();
		
		}
			
		if(count($categories)>0){
			$data = array("Status"=>'true',"SubCategoryDetails"=>$categories ); 
		}else{
			$data = array("Status"=>'false',"SubCategoryDetails"=>$categories ); 
		}
       
           print_r(json_encode($data));


	} 
	public function getSubCategoryLists($store_id,$category_id,$keyword) {
		
		if(isset($keyword)){
			$categories = Category::select('id', 'categoryname','image')->where("store_id",$store_id)->where("parent_id",$category_id)->where('categoryname', 'like', '%' . $keyword . '%')->get();
		   
		}
		if(count($categories)>0){
			$data = array("Status"=>'true',"SubCategoryDetails"=>$categories ); 
		}else{
			$data = array("Status"=>'false',"SubCategoryDetails"=>$categories ); 
		}
       
           print_r(json_encode($data));


	} 
	/*product list*/
	
	public function getProductList(Request $request) {
		$input = $request->all();
		$product = DB::table('products')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('departments', 'departments.id', '=', 'productinventories.department_id')
			->select('products.id', 'products.name as itemname', 'productinventories.quantity', 'productinventories.price',  'products.description')
			->where('productinventories.store_id', $input['store_id'])
			->where('products.category_id', $input['category_id'])
			->orderBy('products.id', 'desc')
			->get();
		
		if(count($product)>0){
			$data = array("Status"=>'true',"ProductDetails"=>$product ); 
		}else{
			$data = array("Status"=>'false',"ProductDetails"=>$product ); 
		}
		
		print_r(json_encode($data));


	}/*single product list*/
	
	public function getSingleProduct(Request $request) {
		$input = $request->all();
		$product = DB::table('products')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('departments', 'departments.id', '=', 'productinventories.department_id')
			->select('products.id', 'products.name as itemname', 'productinventories.quantity', 'productinventories.price',  'products.description')
			
			->where('products.id',$input['id'])
			->orderBy('products.id', 'desc')
			->get();
		
		if(count($product)>0){
			$data = array("Status"=>'true',"ProductDetails"=>$product[0] ); 
		}else{
			$data = array("Status"=>'false',"ProductDetails"=>$product[0] ); 
		}
		
		print_r(json_encode($product[0]));


	}/*Get the latitude of a city*/
	
	public function getLatitudeCity(Request $request) {
		$input = $request->all();
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$input['city'].'&sensor=false');
		$geo = json_decode($geocode, true);
		
		if(count($geo['results']) >0){
		
		if ($geo['status'] = 'OK') {
			$latitude = $geo['results'][0]['geometry']['location']['lat'];
			$longitude = $geo['results'][0]['geometry']['location']['lng'];
			//$status = '{"latitude":"'.$latitude.'","longitude":"'.$longitude.'"}';	
          $status = array('Status'=>'Success','latitude'=>$latitude,'longitude'=>$longitude);			
		}
		else {
			//$status = '{" False "}';
			$status = array('Status'=>'Failed','latitude'=>'','longitude'=>'');
		}
		}else{
			$status = array('Status'=>'Failed','latitude'=>'','longitude'=>'');
		}
    print_r(json_encode($status));

	}/*store list*/
	
	public function getStorelist() {
		
		$store = Store::get();
		
		print_r(json_encode($store));


	}

}
