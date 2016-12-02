<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Role;
use App\Category;
use App\Departments;
use DB;
use Session;
use DEGREES;

use App\Product;
use App\Banner;
use App\Store;
use input;
use App\Http\Requests;
use Hash;
class SubCate
    {
        
        public function getCategoriesdpt($ids,$id){
			

            //$categories=\App\Category::where('parent_id',0)->where("store_id", $id)->where("type", $type)->get();//united
            $categories=\App\Category::join('departments', 'departments.id', '=', 'categories.departments_id')
               
                ->select('categories.id','categories.categoryname','categories.image')
                ->where('categories.parent_id', 0)
				->where('categories.store_id', $ids)
				->where('departments.id', $id)
                ->get();
            $categories=$this->addRelation($categories);

            return $categories;

        } public function getCategoriesdptkey($ids,$id,$key){
			

            //$categories=\App\Category::where('parent_id',0)->where("store_id", $id)->where("type", $type)->get();//united
            $categories=\App\Category::join('departments', 'departments.id', '=', 'categories.departments_id')
               
                ->select('categories.id','categories.categoryname','categories.image')
                ->where('categories.parent_id', 0)
				->where('categories.store_id', $ids)->where('categories.categoryname', 'like', '%' .$key . '%')
				->where('departments.id', $id)
                ->get();
            $categories=$this->addRelation($categories);

            return $categories;

        } public function getCategoriesdpts($ids,$id,$category){
			

            //$categories=\App\Category::where('parent_id',0)->where("store_id", $id)->where("type", $type)->get();//united
            $categories=\App\Category::join('departments', 'departments.id', '=', 'categories.departments_id')
               
                ->select('categories.id','categories.categoryname','categories.image')
                ->where('categories.parent_id', 0)
				->where('categories.store_id', $ids)
				->where('departments.id', $id)
				->where('categories.id', '!=', $category)
                ->get();
            $categories=$this->addRelation($categories);

            return $categories;

        } public function getCategories($id,$type){
			

            $categories=\App\Category::where('parent_id',0)->where("store_id", $id)->where("type", $type)->get();//united

            $categories=$this->addRelation($categories);

            return $categories;

        } public function getCategoriesedit($ids,$id,$type){
			

            $categories=\App\Category::where('parent_id',0)->where("store_id", $ids)->where('id', '!=', $id)->where("type", $type)->get();//united

            $categories=$this->addRelation($categories);

            return $categories;

        }public function showCategorieslist($ids){
			

            $categories=\App\Category::join('departments','departments.id','=','categories.departments_id')
            
             ->select('categories.*','departments.name as dptname ')
             ->where('categories.parent_id',0)
			 ->where("categories.store_id", $ids)
			 ->get();//united

            $categories=$this->addRelation($categories);

            return $categories;

        }public function getCategorieslist($ids){
			

            $categories=\App\Category::where('parent_id',0)->where("store_id", $ids)->get();//united

            $categories=$this->addRelation($categories);

            return $categories;

        }

        protected function selectChild($id)
        {
			$ids = Session::get('store_userid');
            $categories=\App\Category::where('parent_id',$id)->get(); //rooney

            $categories=$this->addRelation($categories);

            return $categories;

        }

        protected function addRelation($categories){

            $categories->map(function ($item, $key) {
                
                $sub=$this->selectChild($item->id); 
                
                return $item=array_add($item,'subCategory',$sub);

            });

            return $categories;
        }
    }
class GroceryWebservice extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function distanceList(Request $request) {
		$input = $request->all();
		
	   
		
		
	   date_default_timezone_set('Asia/Calcutta');
		
	    if($input['time']=='ontheway'){
			 
			 $s=date("d/m/Y h:i:s a", time()); 
			 $time=date('H:i ', strtotime($s));
		}else{
			
			 $time= date('H:i', strtotime($input['time']));
			
		}
	//echo $time;exit;

		if($input['latitude']!='' && $input['longitude'] !=''){
			$latitude = $input["latitude"];
		   $longitude = $input["longitude"];
			$distance = 10;
			$R = 6378.1;
 		    $brng = 1.57;
 		   $conv_fac = 0.621371;
    	   $ds = $distance;
		   $d = $ds/$conv_fac;
	 		$lat1 = deg2rad($latitude);
	 		$lon1 = deg2rad($longitude);
	 
	 		$lat2 = asin(sin($lat1)*cos($d/$R) + cos($lat1)*sin($d/$R)*cos($brng)); 
	 		$lon2 = $lon1 + atan2(sin($brng)*sin($d/$R)*cos($lat1),cos($d/$R)-sin($lat1)*sin($lat2));
	 		  $new_lat = rad2deg ($lat2);
	 		   $new_long = rad2deg($lon2);
			$store=Store::select(
                    DB::raw("id,name,unique_id,corporateidentifier,address,address2,zip,phone,mail,website,opening_time,closing_time,logo,latitude , longitude ,
                              ( 3959 * acos( cos( radians($latitude) ) *
                                cos( radians( latitude ) )
                                * cos( radians( longitude ) - radians($longitude)
                                ) + sin( radians($latitude) ) *
                                sin( radians( latitude ) ) )
                              ) AS distance"))->where('opening_time', '<=', $time)
    ->where('closing_time', '>=', $time)->orderBy("distance")->get();
			//$store = Store::where('latitude', '<=',$new_lat )->where('latitude', '>=',$input['latitude'] )->where('longitude','<=' , $new_long )->where('longitude','>=' , $input['longitude'] )->where('opening_time', '<=', $time)
    //->where('closing_time', '>=', $time)->get();
		}else{
			$store = Store::where('latitude', 'like', '%' . $input['latitude'] . '%')->where('longitude', 'like', '%' . $input['longitude'] . '%')->where('opening_time', '<=', $time)
    ->where('closing_time', '>=', $time)->get();
	//$store=Store::select('id','name','latitude','longitude' ,111.045 * DEGREES(ACOS(COS(RADIANS('0.244799')) * COS(RADIANS('latitude')) * COS(RADIANS('longitude') - RADIANS('0.244799')) + SIN(RADIANS('51.891648')) * SIN(RADIANS('latitude')))))->where('opening_time', '<=', $time)
    //->where('closing_time', '>=', $time)->get();
		}
		
		
        if(count($store)>0){
			$data = array("Status"=>'true',"StoreDetails"=>$store); 
		}else{
			$data = array("Status"=>'false',"StoreDetails"=>$store ); 
		}
        print_r(json_encode($data));


	} public function getDepartmentList(Request $request) {
		$input = $request->all();
		if(isset($input['keyword'])){
			$categories = DB::table('departments')->select('id','name','image')->where("type",0)->where("store_id",$input['store_id'])->where('name', 'like', '%' .$input['keyword'] . '%')->get();
		}else{
			$categories = DB::table('departments')->select('id','name','image')->where("type",0)->where("store_id",$input['store_id'])->get();
		
		}
		$banner=Banner::select('image')->where("store_id",$input['store_id'])->limit(3)->get();
		
        if(count($categories)>0){
			$data = array("Status"=>'true',"categoryDetails"=>$categories ,"banners"=>$banner); 
		}else{
			$data = array("Status"=>'false',"categoryDetails"=>$categories ); 
		}
        print_r(json_encode($data));
	} 
	public function getCategoryList(Request $request) {
		$input = $request->all();
		if(isset($input['keyword'])){
			
			$subcate=new SubCate;
		try {
             $categories=$subcate->getCategoriesdptkey($input['store_id'],$input['department_id'],$input['keyword']);
           // $categories=$subcate->getCategoriesdpt($input['store_id'],$input['department_id']);
            
        } catch (Exception $e) {
            
           
        }
			
			
			//$categories = Category::select('id','categoryname','image')->where("store_id",$input['store_id'])->where('categoryname', 'like', '%' .$input['keyword'] . '%')->get();
		}else{
			//$categories = Category::select('id','categoryname','image')->where("store_id",$input['store_id'])->get();
		
		   
			$subcate=new SubCate;
		try {
            // $categories=$subcate->getCategoriesdpt($input['store_id'],$input['department_id'],$input['keyword']);
            $categories=$subcate->getCategoriesdpt($input['store_id'],$input['department_id']);
            
        } catch (Exception $e) {
            
           
        }
		}
		$banner=Banner::select('image')->where("store_id",$input['store_id'])->limit(3)->get();
		
        if(count($categories)>0){
			$data = array("Status"=>'true',"categoryDetails"=>$categories ,"banners"=>$banner); 
		}else{
			$data = array("Status"=>'false',"categoryDetails"=>$categories ); 
		}
        print_r(json_encode($data));


	}
	
	public function getCategoryListtest(Request $request) {
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
			->select('products.id', 'products.name as itemname', 'productinventories.quantity', 'productinventories.price',  'products.description', 'products.image')
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
			->select('products.id', 'products.name as itemname', 'productinventories.quantity', 'productinventories.price',  'products.description','products.image')
			
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
