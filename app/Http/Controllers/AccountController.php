<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;

class UserController extends Controller
{

public function postChangePassword() {
	$validator = Validator::make(Input::all(),
		array(
			'password' 		=> 'required',
			'old_password'	=> 'required|min:6',
			'password_again'=> 'required|same:password'
		)
	);

	if($validator->fails()) {
		return Redirect::route('account-change-password')
			->withErrors($validator);
	} else {
		// passed validation

		// Grab the current user
		$user 			= User::find(Auth::user()->id);

		// Get passwords from the user's input
		$old_password 	= Input::get('old_password');
		$password 		= Input::get('password');

		// test input password against the existing one
		if(Hash::check($old_password, $user->getAuthPassword())){
			$user->password = Hash::make($password);

			// save the new password
			if($user->save()) {
				return Redirect::route('home')
						->with('global', 'Your password has been changed.');
			}
		} else {
			return Redirect::route('account-change-password')
				->with('global', 'Your old password is incorrect.');
		}
	}

	/* fall back */
	return Redirect::route('account-change-password')
		->with('global', 'Your password could not be changed.');
}
}