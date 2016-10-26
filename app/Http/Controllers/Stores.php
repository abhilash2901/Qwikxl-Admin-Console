<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Store;
use App\Departments;
use DB;
use Session;
use Hash;

class Stores extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index() {
        $id = Session::get('id');

        $user = User::find($id);
        return view('storeuser.storeprofile', compact('user'));
    }

    public function storelists() {
        $id = Session::get('id');
        $user = User::find($id);
        $dept = DB::table('departments')->where('store_id', '=', $user->store_id)->where('type', '=', '0')->get();
        $roles = DB::table('roles')->where('type', '=', '1')->get();
        $users = DB::table('users')->orderBy('id', 'desc')->first();
		$countries = DB::table('countries')->get();
        return view('storeuser.list', ['countries' => $countries,'roles' => $roles, 'users' => $users, 'dept' => $dept]);
    }

    public function liststoreuser(Request $request) {
        $id = Session::get('id');
        $user = User::find($id);
       // $users = Store::find($user->store_id);
        $list = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.store_id', $user->store_id)
                ->get();
		$users = Store::join('countries','stores.country','=','countries.id')
             ->join('states','states.country_id','=','countries.id')
             ->join('cities','cities.state_id','=','states.id')
             ->select('stores.*')
             ->where('stores.id', '=',$user->store_id)
             ->get();		
        print_r(json_encode(array('users' => $users[0], 'storeuser' => $list)));
    }

    public function liststoresuser(Request $request) {
        $id = $request->id;
        $user = User::where("store_id", $id);
        //$users = Store::find($user->store_id);
        print_r(json_encode($user));
    }

    public function editstoredata(Request $request) {
        $input = $request->all();
       
       if(isset($input['mcity']))
       {
        $cityinsert=array(["name"=>$input['mcity'],"state_id"=>$input['state']]);
        
        $id2=DB::table('cities')->insert($cityinsert);
        $store_id = DB::table('cities')->orderBy('id', 'desc')->first();
        $input['city']=$store_id->id;
//        $last = Timelog::orderBy('id', 'desc')->first();
        
       
       }
        $id = $input['id'];
        Store::where("id", $id)->update($input);

        //$item = Item::find($id);
        print_r(json_encode(array('status' => 'success', 'msg' => 'Store Updated Succesfully')));
    }

    public function changepass(Request $request) {

        $input = $request->all();
        $id = $input['id'];
        $ress = User::find($id);
        $input['password'] = Hash::make($input['changepass']);

        if (count($ress) == 1) {

            if (Hash::check($request->input('currentpass'), $ress->password)) {
                $user = User::find($id);

                $user->update($input);
                print_r(json_encode(array('status' => 'success', 'msg' => 'Password Changed Succesfully')));
            } else {
                print_r(json_encode(array('status' => 'failed', 'msg' => 'Current Password is incorect ')));
            }
        }
    }

    public function updates(Request $request) {

        $id = $request->input('id');
        $name = $request->input('name');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $type = $request->input('type');
        $email = $request->input('email');
        $contactnumber = $request->input('contactnumber');


        DB::update('update users set name = ?,firstname = ? ,lastname =? ,type = ?, email = ?, contactnumber = ? where id = ?', [$name, $firstname, $lastname, $type, $email, $contactnumber, $id]);


        //return redirect()->back();
        print_r(json_encode(array('status' => 'success', 'msg' => 'Profile Updated Succesfully')));
        //return redirect()->back()->with('message','Operation Successful !');
    }
	public function deletestore(Request $request) {
		$input = $request->all();
        $ids = $input['id'];
		
		$product =DB::table('productinventories')->where('store_id', '=', $ids)->delete();
		
		$categories =DB::table('categories')->where('store_id', '=', $ids)->delete();
		$departments =DB::table('departments')->where('store_id', '=', $ids)->delete();
		$user =DB::table('users')->where('store_id', '=', $ids)->delete();
		
		
		
		    
		Store::destroy($ids);
		print_r(json_encode(array('status' => 'success', 'msg' => "Store Deleted Succesfully")));	
		
		 
	}
	public function getresults($table,$id) {
		
		$result = DB::table($table)->where('store_id', '=', $id);
		
		 return $result;
	}
	public function deletedpartmt(Request $request) {
		$input = $request->all();
        $id = $input['id'];
		$product =DB::table('productinventories')->where('department_id', '=', $id)->delete();
		$categories =DB::table('categories')->where('departments_id', '=', $id)->delete();
		$departments =DB::table('departments')->where('id', '=', $id)->delete();
		print_r(json_encode(array('status' => 'success', 'msg' => "Departments Deleted Succesfully")));
	}

}
