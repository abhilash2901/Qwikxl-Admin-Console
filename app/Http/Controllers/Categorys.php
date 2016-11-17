<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use App\User;
use App\Role;
use App\Store;
use App\Category;
use App\Departments;
use DB;
use Session;
use Hash;
class SubCate
    {
        
        public function getCategoriesdpt($ids,$id){
			

            //$categories=\App\Category::where('parent_id',0)->where("store_id", $id)->where("type", $type)->get();//united
            $categories=\App\Category::join('departments', 'departments.id', '=', 'categories.departments_id')
               
                ->select('categories.*')
                ->where('categories.parent_id', 0)
				->where('categories.store_id', $ids)
				->where('departments.id', $id)
                ->get();
            $categories=$this->addRelation($categories);

            return $categories;

        } public function getCategoriesdpts($ids,$id,$category){
			

            //$categories=\App\Category::where('parent_id',0)->where("store_id", $id)->where("type", $type)->get();//united
            $categories=\App\Category::join('departments', 'departments.id', '=', 'categories.departments_id')
               
                ->select('categories.*')
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
class Categorys extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index() {
        $ids = Session::get('store_userid');
         
        $categories = Category::where("store_id", $ids)->where("type", "1")->get();
        $categoriesnon = Category::where("store_id", $ids)->where("type", "0")->get();
        $dept = DB::table('departments')->where('store_id', '=', $ids)->get();
		$subcate=new SubCate;
        
        try {

            $allSubCategories=$subcate->getCategories($ids,1);
              $categoriesnon = $subcate->getCategories($ids,0);
        } catch (Exception $e) {
            
            //no parent category found
        }
        

        return view('storeuser.category', ['dept' => $dept,'allSubCategories' => $allSubCategories, 'categories' => $categories, 'categoriesnon' => $categoriesnon])->with('categories', $categories);
    }

    public function categorylist() {
        $ids = Session::get('store_userid');
        //$categories = Category::where("store_id", $ids)->get();
       $subcate=new SubCate;
        try {

            $categories=$subcate->showCategorieslist($ids);
              
        } catch (Exception $e) {
            
            //no parent category found
        }
       
        return view('storeuser.categorylist');
    } public function listingcategory() {
        $ids = Session::get('store_userid');
        //$categories = Category::where("store_id", $ids)->get();
       $subcate=new SubCate;
        try {

            $categories=$subcate->showCategorieslist($ids);
              
        } catch (Exception $e) {
            
            //no parent category found
        }
         print_r(json_encode($categories));
        
    }

    public function editcategory($id) {
        //$input = $request->all();
        //var_dump($id);
        $ids = Session::get('store_userid');
		$subcate=new SubCate;
		try {

            $categories=$subcate->getCategoriesedit($ids,$id,1);
            $categoriesnon = $subcate->getCategoriesedit($ids,$id,0);
        } catch (Exception $e) {
            
            //no parent category found
        }

       // $categories = Category::where("store_id", $ids)->where('id', '!=', $id)->where("type", "1")->get();
        //$categoriesnon = Category::where("store_id", $ids)->where("type", "0")->get();
        $dept = DB::table('departments')->where('store_id', '=', $ids)->get();
        $data = Category::find($id);
        return view('storeuser.editcategory', ['dept' => $dept, 'data' => $data, 'categories' => $categories, 'categoriesnon' => $categoriesnon])->with('categories', $categories);
    }

    public function editscategorylist(Request $request) {
        // $input = $request->all();
        $input = Input::except(['_method', '_token']);
        $input['store_id'] = Session::get('store_userid');
        $id = $input['id'];
		$pic='';
		if (Input::file('image')) {

				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$name = Input::file('image')->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER 
				$fileName = rand(11111, 99999) . '.' . $extension;
				
				$destinationPath = public_path('upload/categories');
                  
               $thumb_img = Image::make($image->getRealPath())->resize(200, 140);
               $thumb_img->save($destinationPath.'/'.$fileName,80);
				//$image->move($path, $fileName);
				$input['image'] = 'upload/categories/' . $fileName;
				$pic=$input['image'];
			}
	 if($input['image']){
	    $input['image']=$input['image'];
	   }else{
	    $categy=Category::where("id", $id)->get();
	    $input['image']=$categy[0]->image;
	   }
        Category::where("id", $id)->update($input);
        print_r(json_encode(array('status' => 'success', 'msg' => 'Store Updated Succesfully','pic'=>$pic)));
    }

    public function deletecategory(Request $request) {
        $input = $request->all();
        $categories = Category::where("parent_id", $input['id'])->get();

        if (count($categories) > 0) {
            print_r(json_encode(array('status' => 'Failed', 'msg' => 'Parent Exist Please Delete The parent')));
        } else {
            Category::where('id', $input)->delete();
            print_r(json_encode(array('status' => 'success', 'msg' => 'Deleted Succesfully')));
        }
    }

    public function addcategory(Request $request) {
        $input = $request->all();
		$pic='';
        $id = Session::get('id');
		if (Input::file('image')) {

				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$name = Input::file('image')->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER 
				$fileName = rand(11111, 99999) . '.' . $extension;
				$destinationPath = public_path('upload/categories');
                  
               $thumb_img = Image::make($image->getRealPath())->resize(200, 140);
               $thumb_img->save($destinationPath.'/'.$fileName,80);
				//$image->move($path, $fileName);
				$input['image'] = 'upload/categories/' . $fileName;
				$pic=$input['image'];
			}
		
        $user = User::find($id);
        $input['store_id'] = $user->store_id;
		  $result =Category::where('categoryname',$input['categoryname'])->get();
		if(count($result)==0){
			$create = Category::create($input);
            print_r(json_encode(array('status' => 'success', 'msg' => 'Category Created Succesfully','pic'=>$pic)));
		}else{
			print_r(json_encode(array('status' => 'Failed', 'msg' => 'Category Exist')));
		}
       
    }

    public function liststoreuser(Request $request) {
        $id = Session::get('id');
        $user = User::find($id);
        $users = Store::find($user->store_id);
        $list = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.store_id', $user->store_id)
                ->get();
        print_r(json_encode(array('users' => $users, 'storeuser' => $list)));
    }

    public function liststoresuser(Request $request) {
        $id = $request->id;
        $user = User::where("store_id", $id);
        //$users = Store::find($user->store_id);
        print_r(json_encode($user));
    }

    public function editstoredata(Request $request) {
        $input = $request->all();

        $id = $input['id'];
        Store::where("id", $id)->update($input);

        //$item = Item::find($id);
        print_r(json_encode(array('status' => 'success', 'msg' => 'Store Updated Succesfully')));
    }

    public function selectcategory(Request $request) {
        $input = $request->all();

        $id = $input['id'];
        $categories = Category::where("departments_id", $id)->get();

        print_r(json_encode($categories));
    }
	public function changedpt(Request $request) {
		$input = $request->all();
        $id = $input['id'];
		
		
		$ids = Session::get('store_userid');
		$subcate=new SubCate;
		try {

            $categories=$subcate->getCategoriesdpt($ids,$id);
            
        } catch (Exception $e) {
            
            //no parent category found
        }
		
		print_r(json_encode($categories));
	}

}
