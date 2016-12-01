<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Role;
use App\Store;
use App\Departments;
use DB;
use Session;
use Image;
use Hash;

class StoreController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createstore() {
        $data = DB::table('stores')->orderBy('id', 'desc')->first();
        $countries = DB::table('countries')->get();
        $users = DB::table('users')->orderBy('id', 'desc')->first();
        $roles = DB::table('roles')->where('type', '=', '1')->get();
        // $list = DB::table('users')->where('type', '=', '1')->get();
        $list = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.type', '1')
                ->get();
        return view('store.addstore', ['id' => $data, 'users' => $users, 'roles' => $roles, 'list' => $list, 'countries' => $countries]);
    }

    public function editstore() {
        $ss = Session::get('store_id');
        $dept = DB::table('departments')->where('store_id', '=', $ss)->where('type', '=', '0')->get();
		$countries = DB::table('countries')->get();
        $data = DB::table('stores')->orderBy('id', 'desc')->first();
        $users = DB::table('users')->orderBy('id', 'desc')->first();
        $roles = DB::table('roles')->where('type', '=', '1')->get();
        // $list = DB::table('users')->where('type', '=', '1')->get();
        $list = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.type', '1')
                ->get();
        return view('store.editstore', ['id' => $data,'countries' => $countries, 'dept' => $dept, 'users' => $users, 'roles' => $roles, 'list' => $list]);
    }

    public function liststoreusers(Request $request) {
        $input = $request->all();
        $list = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.store_id', $input['id'])
                ->get();
        print_r(json_encode($list));
    }

    public function storedetails(Request $request) {
        $input = $request->all();
     
         $stores = DB::table('stores')
             ->leftJoin('countries','stores.country','=','countries.id')
             ->leftJoin('states','stores.state','=','states.id')
             ->leftJoin('cities','stores.city','=','cities.id')
             ->select('stores.*','countries.id as cname','states.id as sname','cities.id as ctname')
             ->where('stores.id', '=',$input['id'])
             ->get();
        print_r(json_encode($stores));
    }

    public function createuserstore(Request $request) {
        $input = $request->all();

        $count = $this->exist_user($input['email']);
        if ($count == 0) {
            $item = array([
                    "unique_id" => $input['unique_id'],
                    "firstname" => $input['firstname'],
                    "lastname" => $input['lastname'],
                    "type" => $input['type'],
                    "email" => $input['email'],
                    "store_id" => $input['store_id']
            ]);

            // move here
            $user = DB::table('users')->insert($item);
            $user_id = DB::table('users')->orderBy('id', 'desc')->first();
            $item2 = array([
                    "user_id" => $user_id->id,
                    "role_id" => $input['role_id']
            ]);

            $user = DB::table('role_user')->insert($item2);

            print_r(json_encode(array('status' => 'success', 'msg' => 'User Created Succesfully')));
        } else {

            print_r(json_encode(array('status' => 'failed', 'msg' => 'User Already Exist')));
        }
    }

    public function exist_user($email) {

        $email = DB::table('users')->where('email', '=', $email)->get();


        return count($email);
    }

    public function liststore() {

        $result = DB::table('stores')->orderBy('id', 'DESC')->get();


        print_r(json_encode($result));
    }

    public function selectstores(Request $request) {
        $input = $request->all();
        //$result = DB::table('stores')->orderBy('id', 'DESC')->get();
        \Session::put('store_id', $input['id']);

        print_r(json_encode(array('status' => 'success', 'msg' => 'Store Created Succesfully', 'id' => $input['id'])));
    }

    public function create(Request $request) {
        /* $this->validate($request, [

          'mail' => 'required|email|unique:users,email',

          'name' => 'required',
          'corporateidentifier'=>'required',
          'address'=>'required',
          'city'=>'required',
          'zip'=>'required|integer',
          'website'=>"required|url"
          ]); */
          $input['city']='';
		  $input['state']='';
		  $input['country']='';$input['image']='';
        $input = $request->all();
        $res = Store::where("mail",$input['mail'])->get();
        if(count($res)==0){
			
       if(isset($input['mcity']))
       {
        $cityinsert=array(["name"=>$input['mcity'],"state_id"=>$input['state']]);
        
        $id2=DB::table('cities')->insert($cityinsert);
        $store_id = DB::table('cities')->orderBy('id', 'desc')->first();
        $input['city']=$store_id->id;

        
       
       }
         if (Input::file()) {

            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $name = Input::file('image')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            // RENAME THE UPLOAD WITH RANDOM NUMBER 
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('logo');


            $thumb_img = Image::make($image->getRealPath())->resize(200, 140);
            $thumb_img->save($path.'/'.$fileName,80);
				//$image->move($path, $fileName);
            $input['image'] = 'logo/' . $fileName;
        }
		
        $item = array([
                "unique_id" => $input['unique_id'],
                "name" => $input['name'],
                "corporateidentifier" => $input['corporateidentifier'],
                "address" => $input['address'],
                "address2" => $input['address2'],
                "city" => $input['city'],
                "state" => $input['state'],
                "country" => $input['country'],
                "zip" => $input['zip'],
                "phone" => $input['phone'],
                "mail" => $input['mail'],
                "website" => $input['website'],
				"latitude" => $input['latitude'],
                "longitude" => $input['longitude'],
				"opening_time" => $input['opening_time'],
                "closing_time" => $input['closing_time'],
				   "logo"=>$input['image']
        ]);


        // move here
		
        DB::table('stores')->insert($item);

        $store_id = DB::table('stores')->orderBy('id', 'desc')->first();
        \Session::put('store_id', $store_id->id);
        $items = array([
                "name" => "general",
                "store_id" => $store_id->id,
                "type" => "1"
        ]);
        DB::table('departments')->insert($items);
        print_r(json_encode(array('status' => 'success', 'class' => 'alert alert-success','msg' => 'Store Created Succesfully', 'id' => $store_id->id)));
			
		}else{
			print_r(json_encode(array('status' => 'failed','class' => 'alert alert-danger', 'msg' => 'Email ID Exist')));
		
		}
    }

    public function storeedit(Request $request) {
        $input['city']='';
	    $input['state']='';
	    $input['country']='';
		$input['image']='';
	 
		$input = $request->all();
       //var_dump($input);
	   //exit;
	   $id = $input['id'];
	    $res = Store::where("mail",$input['mail'])->where('id', '!=',  $id)->get();
		
        if(count($res)==0){
		  if(isset($input['mcity']))
		 {
			$cityinsert=array(["name"=>$input['mcity'],"state_id"=>$input['state']]);
			
			$id2=DB::table('cities')->insert($cityinsert);
			$store_id = DB::table('cities')->orderBy('id', 'desc')->first();
			$input['city']=$store_id->id;
	//        $last = Timelog::orderBy('id', 'desc')->first();
			
		   
		 }
		 
			 if (Input::file()) {

				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$name = Input::file('image')->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER 
				$fileName = rand(11111, 99999) . '.' . $extension;
				$path = public_path('logo');
				$thumb_img = Image::make($image->getRealPath())->resize(200, 140);
				$thumb_img->save($path.'/'.$fileName,80);
				$input['image'] = 'logo/' . $fileName;
			}
			$id = $input['id'];
			if($input['image'] ){
				$input['image']=$input['image'];
			}else{
				 $row =Store::where("id", $id)->get();
				 $input['image']=$row[0]->logo;
			}
		   if(isset($input['city'])){
			 $input['city']=$input['city'];
		   }else{
			   $input['city']='';
		   }if(isset($input['state'])){
			 $input['state']=$input['state'];
		   }else{
			   $input['state']='';
		   }if(isset($input['country'])){
			 $input['country']=$input['country'];
		   }else{
			   $input['country']='';
		   }
			
			/*$item = array([
					"unique_id" => $input['unique_id']+$id,
					"name" => $input['name'],
					"corporateidentifier" => $input['corporateidentifier'],
					"address" => $input['address'],
					"address2" => $input['address2'],
					"city" => $input['city'],
					"state" => $input['state'],
					"country" => $input['country'],
					"zip" => $input['zip'],
					"phone" => $input['phone'],
					"mail" => $input['mail'],

					"website" => $input['website'],
					"latitude" => $input['latitude'],
					"longitude" => $input['longitude']
			]);

					"website" => $input['website']
			]);*/


			// move here
			// DB::table('stores')->insert($item );
			
			

				   DB::update('update stores set name = ? ,corporateidentifier = ? ,address = ? ,address2 = ? ,country = ?,city = ?,state = ? ,zip = ?,latitude=?,longitude=?,opening_time=?,closing_time=?,phone = ?,mail = ?,website = ?,logo = ? where id = ?', [$input['name'], $input['corporateidentifier'], $input['address'], $input['address2'], $input['country'],$input['city'], $input['state'], $input['zip'],$input['latitude'],$input['longitude'],$input['opening_time'],$input['closing_time'], $input['phone'], $input['mail'], $input['website'],$input['image'], $id]);
	  
			/* $id = $input['id'];
			  $user = Store::find($id);

					$user->update($input);*/
					// $data = DB::table('stores')->where('id',$input['id'])->get();

			print_r(json_encode(array('status' => 'success','class' => 'alert alert-success', 'msg' => 'Store Created Succesfully','image'=>$input['image'])));
		}else{
			print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Email ID Exist')));
		
		}
	}

    public function deleteusers(Request $request) {
        $input = $request->all();
        $id = $input['id'];

        User::destroy($id);


        print_r(json_encode(array('status' => 'success', 'msg' => 'User Delete Succesfully')));
    }

    public function getuserdetails(Request $request) {
        $input = $request->all();
        $id = $input['id'];

        $list = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.type', '1')
                ->where('users.id', $id)
                ->get();


        print_r(json_encode($list));
    }

    public function edituser(Request $request) {
        $input = $request->all();

        $id = $input['id'];
        $user = User::find($id);
        $user->update($input);
        DB::update('update role_user set role_id = ? where user_id = ?', [$input['role_id'], $id]);


        print_r(json_encode(array('status' => 'success', 'msg' => 'Updated Succesfully')));
    }

    public function adddept(Request $request) {
        $input = $request->all();

        foreach ($request->input('name') as $key => $value) {
            $sqlInsert = array(
                array('name' => $value, 'store_id' => $input['store_id'])
            );
            DB::table('departments')->insert($sqlInsert);
        }


        print_r(json_encode(array('status' => 'success', 'msg' => 'Updated Succesfully')));
    } public function listdepartments(Request $request) {
        $input = $request->all(); 
        $result= DB::table('departments')->where('store_id',$input['store_id'])->where('type',0)->orderBy('id','DESC')->get();
        


        print_r(json_encode($result));
    } public function departmentedit(Request $request) {
        $input = $request->all(); 
        $result= DB::table('departments')->where('id',$input['id'])->get();
        


        print_r(json_encode($result[0]));
    } public function adddepts(Request $request) {
        $input = $request->all();
		$res = DB::table('departments')->where("name",$input['name'])->get();
		
        if(count($res)==0){
            if (Input::file('image')) {

				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$name = Input::file('image')->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER 
				$fileName = rand(11111, 99999) . '.' . $extension;
				$destinationPath = public_path('upload/departments');
                $thumb_img = Image::make($image->getRealPath())->resize(1000, 450);
                $thumb_img->save($destinationPath.'/'.$fileName);
				//$image->move($path, $fileName);
				$input['image'] = 'upload/departments/' . $fileName;
			}
       
            
            DB::table('departments')->insert($input);
           print_r(json_encode(array('status' => 'success','class' => 'alert alert-success', 'msg' => 'Updated Succesfully','storeid'=>$input['store_id'])));
		}else{
			print_r(json_encode(array('status' => 'failed','class' => 'alert alert-danger', 'msg' => 'Departments Exist')));
		
		}
    }public function dptsupdate(Request $request) {
        $input = $request->all();
		$res = DB::table('departments')->where("name",$input['name'])->where('id','!=',$input['id'])->get();
		
        if(count($res)==0){
            if (Input::file('image')) {

				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$name = Input::file('image')->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER 
				$fileName = rand(11111, 99999) . '.' . $extension;
				$destinationPath = public_path('upload/departments');
                $thumb_img = Image::make($image->getRealPath())->resize(1000, 450);
                $thumb_img->save($destinationPath.'/'.$fileName);
				//$image->move($path, $fileName);
				$input['image'] = 'upload/departments/' . $fileName;
			}
            if($input['image'] ){
				$input['image']=$input['image'];
			}else{
				$result = DB::table('departments')->where('id',$input['id'])->get();
				$input['image']=$result[0]->image;
			}
            $res = DB::table('departments')->where('id',$input['id']);
            $res->update($input);
            //DB::table('departments')->insert($input);
         print_r(json_encode(array('status' => 'success','class' => 'alert alert-success', 'msg' => 'Updated Succesfully','image'=>$input['image'])));
        }else{
			print_r(json_encode(array('status' => 'failed','class' => 'alert alert-danger', 'msg' => 'Departments Exist')));
		
		}
	}

    public function editdept(Request $request) {
        $input = $request->all();
        $i = 0;
        foreach ($request->input('name') as $key => $value) {
            $sqlInsert = array(
                array('name' => $value, 'store_id' => $input['store_id'])
            );
            $s = $i + 1;

            if (count($request->input('id')) > $i) {
                if ($request->input('id')[$i]) {
                    $id = $request->input('id')[$i];

                    DB::update('update departments set  name = ? where id =?', [$value, $id]);
                }
            } else {
                $sqlInsert = array(
                    array('name' => $value, 'store_id' => $input['store_id'])
                );
                DB::table('departments')->insert($sqlInsert);
            }


            $i++;
        }


        print_r(json_encode(array('status' => 'success', 'msg' => 'Updated Succesfully')));
    }

    public function findstore() {

        return view('store.findstore');
    }

    public function autocomplete(Request $request) {

        $term = $request->input('term');
        ;

        $results = array();

        $queries = DB::table('stores')
                        ->where('name', 'LIKE', '%' . $term . '%')
                        //->orWhere('lastname', 'LIKE', '%'.$term.'%')
                        ->take(5)->get();

        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->name];
        }
        return \Response::json($results);
    }

    public function findstores() {

        return view('store.findstore');
    }

    public function autocompletes(Request $request) {

        $term = $request->input('term');
       

        $results = array();

        $queries = DB::table('stores')
                        ->where('unique_id', 'LIKE', '%' . $term . '%')
                        //->orWhere('lastname', 'LIKE', '%'.$term.'%')
                        ->take(5)->get();

        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->unique_id];
        }
        return \Response::json($results);
    }

//sooraj
    public function insertcity(Request $request) {
        $name = $request->input('id');
        $state = $request->input('id1');

        DB::table('cities')->insert(
                ['name' => $name, 'state_id' => $state]
        );
    }

    public function state(Request $request) {
        $state_id = $request->input('id');
        $states = DB::table('states')->where('country_id', '=', $state_id)->get();
        // return view('store.addstore', ['states' => $states]);
        return Response::json($states);
    }

    public function city(Request $request) {
        $state_id = $request->input('id');
        $cities = DB::table('cities')->where('state_id', '=', $state_id)->get();
        return Response::json($cities);
    }

}
