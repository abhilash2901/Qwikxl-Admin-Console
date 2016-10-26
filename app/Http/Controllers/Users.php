<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class Users extends Controller {

    public function showAll() {
        //Shows Both Users and Managers ::: For the listing purpose only 
        $users = App\User::all();
        $result_users = $users;
        $i = 0;
        foreach ($users as $user) {
            $result_users[$i]->role = $user->userrole->role["title"];
            $i++;
        }
        return response()->json($result_users);
    }

    public function showUsers() {
        //shows Only Users ;;; for the assigning purpose
        $users = App\Userrole::where('role_id', 2)->get();
        $i = 0;
        foreach ($users as $user) {
            $result_users[$i] = ["name" => $user->user->firstname . " " . $user->user->lastname, "id" => $user->user->id, "title" => $user->user->userrole->role->title];
            $i++;
        }
        return response()->json($result_users);
    }

    public function showStoreUsers() {
        session_start();
        $users = App\User::where('store_id', $_SESSION["store_id"]);
        $result_users = $users->get();
        $i = 0;
        foreach ($users as $user) {
            $result_users[$i]->role = $user->userrole->role["title"];
            $i++;
        }
        return response()->json($result_users);
    }

    public function showUser() {
        //Shows the logged in person for the profile view
        session_start();
        $user = App\User::find($_SESSION['user_id']);
        $storename = $user->store->name;
        $role = $user->userrole->role->title;
        $logo = $user->store->logo;
        $result_data = ["name" => $user->firstname . " " . $user->lastname,
            "id" => $user->id,
            "role" => $role,
            "store" => $storename,
            "logo" => $logo
        ];
        return response()->json($result_data);
    }

    public function listone($id) {//Displays The data for the editing purpose 
        session_start();
        $user_type = $_SESSION["user_type"];
        if ($user_type == "Manager") {
            //Authendicated to access Any Detail....
            $user = App\User::find($id);
            // Returning all the available Roles also...
            $user->roles = App\Role::select('id', 'title')->get();
        } else {
            //Return the details of the logged in user irrespective of the url
            $user = App\User::find($_SESSION["user_id"]);
            $user->roles = App\Role::select('id', 'title')->get();
        }
        return response()->json($user);
    }

    public function update(Request $request) {
        $user = App\User::find($request->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->contactnumber = $request->contactnumber;
        $user->save();
        $userrole = App\Userrole::where('user_id', $user->id)->get()[0];
        if ($request->role == "manager") {
            $userrole->role_id = 1; //for manager
        } else if ($request->role == "user") {
            $userrole->role_id = 2;
        }
        $userrole->save();
        echo "Profile Updated";
    }

    public function createUser(Request $request) {
        session_start();
        $user = new App\User;
        $user->store_id = $_SESSION["store_id"];
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email1;
        $user->contactnumber = $request->contactnumber;
        $user->save();
        $userrole = new App\Userrole;
        $userrole->user_id = $user->id;
        if ($request->role == "manager") {
            $userrole->role_id = 1; //for manager
        } else if ($request->role == "user") {
            $userrole->role_id = 2;
        }
        $userrole->save();

        var_dump($user->id);
        echo "User Created";
    }

    public function deleteUser($id) {
        $user = App\User::find($id);
        $user->userrole->forceDelete();
        $user->forceDelete();
    }

    public function pswdvalidate(Request $request) {
        $query = App\User::whereRaw("email=? AND password=?", [$request->email, $request->password]);
        $user = $query->get();
        if (count($user)) {
            $response_data = $user[0];
            $response_data->login = true;
            setcookie('store_id', $user[0]['store_id'], time() + (60 * 20), "/");
            setcookie('user_id', $user[0]['id'], time() + (60 * 20), "/");
            setcookie('user_type', $user[0]->userrole->role->title, time() + (60 * 20), "/");
            session_start();
            $_SESSION["store_id"] = $user[0]['store_id'];
            $_SESSION["user_id"] = $user[0]['id'];
            $_SESSION["user_type"] = $user[0]->userrole->role->title;
        } else {
            $response_data = "Invalid Credentials!";
        }
        return response()->json($response_data);
    }

    public function logout() {
        setcookie('user_id', '', time() - (30 * 86400), "/");
        setcookie('user_type', '', time() - (30 * 86400), "/");
    }

}
