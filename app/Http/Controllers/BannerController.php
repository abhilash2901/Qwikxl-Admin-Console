<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Response;
use App\User;
use App\Customer;
use App\Role;
use App\Departments;
use DB;
use Session;
use App\Category;
use App\Order;
use App\Banner;
use App\Country;
use App\Product;
use App\Orderdetail;
use App\Productinventory;
use App\Store;

use Hash;
class BannerController  extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function savebanner(Request $request) {
		$input = $request->all();
		//$input['store_id']=$input['store_id'];
        if (Input::file('image')) {

            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $name = Input::file('image')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            // RENAME THE UPLOAD WITH RANDOM NUMBER 
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('banner/');


            $image->move($path, $fileName);
            $input['image'] = 'banner/' . $fileName;
        }
		$create = Banner::create($input);
		
		 print_r(json_encode(array('status' => 'success', 'msg' => 'Banner Created Succesfully','id'=>$input['store_id'])));
		
    }
	  public function listbanner(Request $request) {
		  $input = $request->all();
		  $list = Banner::where('store_id',$input['id'])->orderBy('id', 'desc')->get();
		  print_r(json_encode($list));
	    } 
	  public function banneredit(Request $request) {
			$input = $request->all();
			$id = $input['id'];
		   
			$banner = Banner::find($id);


			print_r(json_encode($banner));
       }
	 public function bannerupdate(Request $request) {
		 $input = $request->all();
		
		 if (Input::file('image')) {

				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$name = Input::file('image')->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER 
				$fileName = rand(11111, 99999) . '.' . $extension;
				$path = public_path('banner/');


				$image->move($path, $fileName);
				$input['image'] = 'banner/' . $fileName;
			}
			
			$res = Banner::where('id',$input['id']);
            $res->update($input);
			$result =Banner::find($input['id']);
			
	           print_r(json_encode(array('status' => 'success', 'msg' => 'Banner Updated Succesfully','id'=>$result->store_id,'img'=>$result->image)));
	   }public function bannerdelete(Request $request) {


        $input = $request->all();
        $id = $input['id'];

        DB::table("banners")->where('id', $id)->delete();


        print_r(json_encode(array('status' => 'success', 'msg' => 'Banner Delete Succesfully')));
    }
	
}
