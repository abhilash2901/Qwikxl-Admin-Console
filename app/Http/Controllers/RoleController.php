<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Permission;
use DB;
use Schema;

class RoleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //$roles = Role::orderBy('id', 'DESC')->paginate(5);
		
        return view('roles.index');
    }
     public function listingroles(Request $request) {
		 
		 $roles = Role::orderBy('id', 'DESC')->get();
		 $i=0;
		 foreach($roles as $role){
			 if($role->type==1){
				 $s ="Store";
			 }else{
				 $s ="System";
			 }
			 $roles[$i]['type']= $s;
			 $i++;
		 }
		 print_r(json_encode($roles));
	 }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permission = Permission::where('permissiontype', 0)->get();
		$permissionstore = Permission::where('permissiontype', 1)->get();
        return view('roles.create', compact('permission','permissionstore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
         $input = $request->all();
        $res = Role::where("name",$input['name'])->get();
		if($input['name']!=''  ){
		if(count($res)==0){
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('name');
        $role->description = $request->input('description');
        $role->type = $request->input('type');
        $role->save();
        if($request->input('permission')){
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
		}
        print_r(json_encode(array('status' => 'success','class' => 'alert alert-success', 'msg' => 'Role created successfully')));
		
        
		}else{
			print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Role Exist')));
		
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
        $role = Role::find($id);
        $rolePermissions = Permission::join("permission_role", "permission_role.permission_id", "=", "permissions.id")
                ->where("permission_role.role_id", $id)
                ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
         $input = $request->all();
		 $id=$input['id'];
        $role = Role::find($id);
        $permission = Permission::where('permissiontype', 0)->get();
		$permissionstore = Permission::where('permissiontype', 1)->get();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id", $id)
                ->lists('permission_role.permission_id', 'permission_role.permission_id');

        return view('roles.edit', compact('role', 'permission', 'rolePermissions','permissionstore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'display_name' => 'required|min:3',
            'description' => 'required|max:150',
            'permission' => 'required',
        ]);
         $input = $request->all();
		$role = Role::find($id);
		
		$roleuser = DB::table("role_user")->where("role_id",$id)->get();
		
		if($role['type'] !=$input['type']){
			foreach($roleuser as $user){
				DB::table("role_user")->where('user_id', $user->user_id)->delete();
			}
			
			
		    // DB::update('update users set role_id = ? where user_id = ?', [$roleuser[0]['user_id'], $id]); 
			$role->display_name = $request->input('display_name');
			$role->description = $request->input('description');
			$role->type = $request->input('type');
			$role->save();

			DB::table("permission_role")->where("permission_role.role_id", $id)
					->delete();

			foreach ($request->input('permission') as $key => $value) {
				$role->attachPermission($value);
			}

			return redirect()->route('roles.index')
							->with('success', 'Role updated successfully');
			
		}else{
			$role->display_name = $request->input('display_name');
			$role->description = $request->input('description');
			$role->type = $request->input('type');
			$role->save();

			DB::table("permission_role")->where("permission_role.role_id", $id)
					->delete();

			foreach ($request->input('permission') as $key => $value) {
				$role->attachPermission($value);
			}

			return redirect()->route('roles.index')
							->with('success', 'Role updated successfully');
		}
        
		
        
    }

    public function roleupdate(Request $request) { 
	    $input = $request->all();
		$res = Role::where("name",$input['display_name'])->where("id",'!=',$input['id'])->get();
		if($input['display_name']!=''  ){
		if(count($res)==0){
	    $role = Role::find($input['id']);
		$roleuser = DB::table("role_user")->where("role_id",$input['id'])->get();
		
		if($role['type'] !=$input['type']){
			foreach($roleuser as $user){
				DB::table("role_user")->where('user_id', $user->user_id)->delete();
			}
			
			
		    // DB::update('update users set role_id = ? where user_id = ?', [$roleuser[0]['user_id'], $id]); 
			
			
		}
			$role->display_name = $request->input('display_name');
			$role->description = $request->input('description');
			$role->type = $request->input('type');
			$role->save();

			DB::table("permission_role")->where("permission_role.role_id", $input['id'])
					->delete();
            if($request->input('permission')){
			foreach ($request->input('permission') as $key => $value) {
				$role->attachPermission($value);
			}
			}
			print_r(json_encode(array('status' => 'success', 'msg' => 'Updated Succesfully', 'class' => 'alert alert-success')));
		}else{
			 print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Role Exist')));
		}
		}else{
			 print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Please Fill All Fields')));
		
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
		$res = User::where("email",$email)->where('id', '!=',  $id)->get();
		
        if(count($res)==0){
        DB::update('update users set name = ?,firstname = ? ,lastname =? ,type = ?, email = ?, contactnumber = ? where id = ?', [$name, $firstname, $lastname, $type, $email, $contactnumber, $id]);


        //return redirect()->back();
        print_r(json_encode(array('status' => 'success', 'class' => 'alert alert-success','msg' => 'Profile Updated Succesfully')));
        //return redirect()->back()->with('message','Operation Successful !');
		}else{
			print_r(json_encode(array('status' => 'failed', 'class' => 'alert alert-danger','msg' => 'Email ID Exist')));
		
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
       $id =$request->input('id');
        //Role::find($id)->delete();
		$user =DB::table("role_user")->where("role_id", $id)->get();
		
		if($user){
			DB::table("users")->where('id', $user[0]->id)->delete();
		}
		
		DB::table("role_user")->where('role_id', $id)->delete();
        DB::table("roles")->where('id', $id)->delete();
        //return redirect()->route('roles.index')
                 //       ->with('success', 'Role deleted successfully');
		  print_r(json_encode(array('status' => 'success', 'msg' => 'Deleted Succesfully')));
    }

}
