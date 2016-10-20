<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
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
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
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
        $this->validate($request, [
            'name' => 'required|unique:roles,name|min:3',
            'description' => 'required|max:150',
            'permission' => 'required', 'type' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('name');
        $role->description = $request->input('description');
        $role->type = $request->input('type');
        $role->save();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')
                        ->with('success', 'Role created successfully');
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
    public function edit($id) {
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

        $role = Role::find($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        //Role::find($id)->delete();
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
                        ->with('success', 'Role deleted successfully');
    }

}
