<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Role;
use App\Store;
use App\Product;
use App\Departments;
use App\Productinventory;
use App\Category;
use DB;
use Session;
use Excel;
use Image;
use Hash;
class SubCate
    {
        
        public function getCategories_listing($id){
			

            $categories=\App\Category::where('parent_id',0)->where("store_id", $id)->get();//united

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
class Products extends Controller {

    public function index() {

        $ids = Session::get('store_userid');
        $data = DB::table('products')->orderBy('id', 'desc')->first();
        $dept = DB::table('departments')->where('store_id', '=', $ids)->where('type', '=', 0)->get();
        $normaldept = DB::table('departments')->where('store_id', '=', $ids)->where('type', '=', 1)->get();
      //  $categories = Category::where("store_id", $ids)->where("type", "1")->get();
       // $categoriesnon = Category::where("store_id", $ids)->where("type", "0")->get();
	   $subcate=new SubCate;
        try {

		  $categories=$subcate->getCategories($ids,1);
		  $categoriesnon = $subcate->getCategories($ids,0);
        } catch (Exception $e) {
            
            //no parent category found
        }
        return view('products.addproduct', ['id' => $data, 'dept' => $dept, 'normaldept' => $normaldept, 'categories' => $categories, 'categoriesnon' => $categoriesnon]);
    }

    public function listproduct() {
        $ids = Session::get('store_userid');
        //$data =$this->belongsTo(Product::class, product_id);
        $data = DB::table('products')
                ->join('productinventories', 'products.id', '=', 'productinventories.product_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('departments', 'departments.id', '=', 'productinventories.department_id')
                ->select('products.id', 'products.name', 'productinventories.price', 'departments.name as departments', 'categories.categoryname')
                ->where('productinventories.store_id', $ids)
                ->orderBy('products.id', 'desc')
                ->get();
				
        $dept = DB::table('departments')->where('store_id', '=', $ids)->get();
		 $subcate=new SubCate;
        try {

		  $categories=$subcate->getCategories_listing($ids);
		  
        } catch (Exception $e) {
            
            //no parent category found
        }
          
        return view('products.listproduct', ['dept' => $dept,'category' =>  $categories]);
    }

    public function listingproducts() {
        $ids = Session::get('store_userid');
        //$data =$this->belongsTo(Product::class, product_id);
        $data = DB::table('products')
                ->join('productinventories', 'products.id', '=', 'productinventories.product_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('departments', 'departments.id', '=', 'productinventories.department_id')
                ->select('products.id', 'products.name', 'products.description', 'products.unique_id', 'productinventories.quantity', 'productinventories.price', 'departments.id as departments_id', 'departments.name as departments', 'categories.categoryname')
                ->where('productinventories.store_id', $ids)
                ->orderBy('products.id', 'desc')
                ->get();
        print_r(json_encode($data));
		
    }

    public function editproduct($id) {
        $ids = Session::get('store_userid');

        $dept = DB::table('departments')->where('store_id', '=', $ids)->where('type', '=', 0)->get();
        $normaldept = DB::table('departments')->where('store_id', '=', $ids)->where('type', '=', 1)->get();
        $subcate=new SubCate;
        try {

		  $categories=$subcate->getCategories($ids,1);
		  $categoriesnon = $subcate->getCategories($ids,0);
        } catch (Exception $e) {
            
            //no parent category found
        }
        $data = DB::table('products')
                ->join('productinventories', 'products.id', '=', 'productinventories.product_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('departments', 'departments.id', '=', 'productinventories.department_id')
                ->select('products.id', 'departments.type as dpt_type', 'products.unique_id', 'products.name', 'products.image', 'products.description', 'productinventories.quantity', 'productinventories.price', 'categories.id as categories_id', 'departments.id as departments_id', 'departments.name as departments', 'categories.categoryname')
                ->where('productinventories.store_id', $ids)
                ->where('products.id', $id)
                ->get();
        return view('products.editproduct', ['data' => $data[0], 'dept' => $dept, 'normaldept' => $normaldept, 'categories' => $categories, 'categoriesnon' => $categoriesnon]);
    }

    public function removepic(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        $input['image'] = '';
        Product::where("id", $id)->update($input);
        print_r(json_encode(array('status' => 'success', 'msg' => 'Product Image Deleted Succesfully')));
    }

    public function deleteproduct(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        productinventory::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();

        print_r(json_encode(array('status' => 'success', 'msg' => 'Product Deleted Succesfully')));
    }

    public function updateproduct(Request $request) {
        $input = $request->all();
       // $input['image'] = '';
        if (Input::file()) {

            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $name = Input::file('image')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            // RENAME THE UPLOAD WITH RANDOM NUMBER 
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('upload');


            $thumb_img = Image::make($image->getRealPath())->resize(200, 140);
            $thumb_img->save($path.'/'.$fileName,80);
            //$image->move($path, $fileName);
            $input['image'] = 'upload/'.$fileName;
        }

        $id = $input['id'];
         if($input['image']){
			 $input['image']=$input['image'];
		 }else{
			 $res=Product::where("id", $id)->get();
			 $input['image']=$res[0]->image;
		 }
		
        $product['category_id'] = $input['category_id'];
        $product['unique_id'] = $input['unique_id'];
        $product['name'] = $input['name'];
        $product['description'] = $input['description'];
        $product['image'] = $input['image'];

        Product::where("id", $id)->update($product);

        $invtry['department_id'] = $input['department_id'];
        $invtry['price'] = $input['price'];
		

        $invtry['quantity'] = $input['quantity'];


        productinventory::where("product_id", $id)->update($invtry);

        print_r(json_encode(array('status' => 'success', 'msg' => 'Product Updated Succesfully', 'pic' => $input['image'])));
    }

    public function saveproduct(Request $request) {
        $input = $request->all();
		
        if (Input::file()) {

            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $name = Input::file('image')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            // RENAME THE UPLOAD WITH RANDOM NUMBER 
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('upload');

            $thumb_img = Image::make($image->getRealPath())->resize(200, 140);
            $thumb_img->save($path.'/'.$fileName,80);
            $image->move($path, $fileName);
            $input['image'] = 'upload/' . $fileName;
        }
		

        $input['store_id'] = Session::get('store_userid');

        $create = Product::create($input);
        $invtry['product_id'] = $create->id;
		$invtry['department_id'] = $input['departments_id'];
        $invtry['price'] = $input['price'];
		$invtry['store_id'] = $input['store_id'];
		

        $invtry['quantity'] = $input['quantity'];
        $invry = productinventory::create($invtry);
        print_r(json_encode(array('status' => 'success', 'msg' => 'Product Created Succesfully', 'pic' => $create->image)));
    }

    public function getdepatments(Request $request) {
        $input = $request->all();
        $ids = Session::get('store_userid');
        $id = $input['type'];
        $dept = DB::table('departments')->where('store_id', '=', $ids)->where('type', '!=', $input['type'])->get();

        print_r(json_encode($dept));
    }
    public function import() {
        $ids = Session::get('store_userid');
        //$categories = Category::where("store_id", $ids)->where("type", "1")->get();
        //$categoriesnon = Category::where("store_id", $ids)->where("type", "0")->get();
		$subcate=new SubCate;
        
        try {

            $categories=$subcate->getCategories($ids,1);
            $categoriesnon = $subcate->getCategories($ids,0);
        } catch (Exception $e) {
            
            //no parent category found
        }

        return view('import.import',[ 'categories' => $categories, 'categoriesnon' => $categoriesnon]);
    }
	   public function dumpproduct(Request $request) {
		    $input = $request->all();
			
			 $data = DB::table('products')->orderBy('id', 'desc')->first();
			 $id='0';
			 if($data){
				 $id=$data->id;
			 }
			 $u =rand();
			 $unique_id=$u +$id;	
			
			$input['store_id']=Session::get('store_userid');
		   if($request->hasFile('import_file')){
			$path = $request->file('import_file')->getRealPath();

			$data = Excel::load($path, function($reader) {})->get();
             
			if(!empty($data) && $data->count()){

				foreach ($data->toArray() as $key => $v) {
					if(!empty($v)){
						
						
						
						//foreach ($value as $v) {
                           						
							$insert = ['name' => $v['name'],'unique_id' =>mt_rand(100000,999999),'category_id' =>$input['category_id'], 'description' => $v['description']];
						 	$ids=Product::create($insert);
							
							$item=['product_id' => $ids->id,'store_id' => $input['store_id'],'department_id' => $input['department_id'],'price' => $v['price'],'quantity' => $v['quantity']];
							 DB::table('productinventories')->insert($item);
						    
						//}
					}
				}

				
				

			}
			 print_r(json_encode(array('status' => 'success', 'msg' => 'Product Import Succesfully')));

		}
	   } public function downloadExcel(Request $request, $type)
		{
		  
		}
}
