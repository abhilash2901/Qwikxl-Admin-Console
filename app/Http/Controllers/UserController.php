<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Role;
use App\Store;
use App\Departments;
use DB;
use Session;
use Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $id = Session::get('id');
		
       // $data = User::where('id', '!=', $id)->orderBy('id', 'DESC')->paginate(5);
		$store = Store::get();
		$role = Role::get();
        return view('users.index', compact('store','role'));
    }
  public function listingusers(Request $request) {
        $id = Session::get('id');
        $data = User::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
		->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
		->select('users.*','roles.name as rolesname','roles.type as rolestype','roles.display_name as displayname')
		->where('users.id', '!=', $id)->orderBy('users.id', 'DESC')->get();
		
		$i=0;
		 foreach($data as $role){
			 if($role->rolestype==1){
				 $s ="Store";
			 }else{
				 $s ="System";
			 }
			 $data[$i]['rolestype']= $s;
			 $i++;
		 }
        print_r(json_encode($data));
    }

    public function storess() {
        $data = DB::select('select * from stores');
        return view('users.store', ['roles' => $data]);
    }

  

    public function already_exist($email) {

        $res = DB::table('users')->where('email', '=', $email)->get();

        //var_dump($res);
        return count($res);
    }

    public function save_storedetails($input) {

        $item = array([
                "id_buy" => $id_buy[$key],
                "name_product" => $name_product[$key],
                "picture" => $picture[$key],
                "price" => $price[$key],
                "quantity" => $quantity[$key]
        ]);

        // move here
        DB::table('detail_bills')->insert($item);
        return count($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::lists('display_name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getroles() {
        $name = $_POST['type'];
        $res = DB::table('roles')->where('type', '=', $name)->get();
        $stores = DB::table('stores')->get();

        return json_encode(array('roles' => $res, 'stores' => $stores));
    }

    public function store(Request $request) {
        

        $input = $request->all();
		
       $res = User::where("email",$input['email'])->get();
		if($input['email']!='' && $input['password']!='' && $input['type']!=''  ){
        if(count($res)==0){
			$input['password'] = Hash::make($input['password']);

			$user = User::create($input);

			$user->attachRole($request->input('roles'));


            print_r(json_encode(array('status' => 'success','class' => 'alert alert-success', 'msg' => 'User Created Succesfully')));
		}else{
			 print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Email ID Exist')));
		}
		}else{
			 print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Please Fill All Fields')));
		
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function showprofile($id) {
        $user = User::find($id);
        return view('users.showprofile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
		$users  = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*', 'roles.display_name', 'roles.id as role_id ')
                ->where('users.id', $id)
                ->get();
        $roles = Role::lists('display_name', 'id');
        $store = DB::select('select * from stores');
        $userRole = $user->roles->lists('id', 'id')->toArray();



        return view('users.edit', compact('user','users', 'roles', 'userRole', 'store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        
		 $input = $request->all();
		 $id=$input['id'];
         $res = User::where("email",$input['email'])->where('id', '!=',  $input['id'])->get();
		if($input['email']!=''&& $input['type']!=''  ){
        if(count($res)==0){
       
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id', $id)->delete();



        $user->attachRole($request->input('roles'));


         print_r(json_encode(array('status' => 'success','class' => 'alert alert-success', 'msg' => 'Updated Succesfully')));
		
		}else{
		   print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Email ID Exist')));
		}
		}else{
			 print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Please Fill All Fields')));
		
		}
    }

    public function updateprofile(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required', 'firstname' => 'required', 'lastname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $input = $request->all();


        $user = User::find($id);
        $user->update($input);
        DB::table('user')->where('id', $id)->delete();




        return redirect()->route('users.showprofile')
                        ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
		$input = $request->all();
		
		DB::table("role_user")->where('user_id',$input['id'])->delete();
        User::find($input['id'])->delete();
        print_r(json_encode(array('status' => 'success', 'msg' => 'Dleted Succesfully')));
    }

    public function changepass(Request $request) {

        $input = $request->all();
        $id = $input['id'];
        $ress = User::find($id);
        $input['password'] = Hash::make($input['changepass']);
        //$count = DB::table('users')->where('id',$id)->where('password',$password)->get();
        if (count($ress) == 1) {
            //Hash::check(Input::get('admin_password'), $validate_admin->password))
            if (Hash::check($request->input('currentpass'), $ress->password)) {
                $user = User::find($id);

                $user->update($input);
                print_r(json_encode(array('status' => 'success', 'msg' => 'Password Changed Succesfully')));
            } else {
                print_r(json_encode(array('status' => 'failed', 'msg' => 'Current Password is incorrect ')));
            }
        }
    }

}
