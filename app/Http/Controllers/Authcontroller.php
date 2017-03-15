<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Session;
use Redirect;

class Authcontroller extends Controller
{
    //

    public function login(Request $req) {

    	if(Auth::attempt(['username' => $req -> input('username'), 'password' => $req -> input('password')]))
    		{
                $user = User::where('username',$req->input('username')) -> first();

    			session(['user' => $req->input('username'), 'role' => $user->role]);
                setcookie('admin','loged', time() + (60*15));

    			return Redirect::to('/dev-admin/dashboard');
    		}
    	else
    		{
                $msg = "<div class='alert alert-danger'>Fail Login, check your username and password</div>";

    			return Redirect::to('/dev-admin') -> with('msg', $msg);
    		}
    }

    public function logout(Request $req) {

        $req -> session() -> flush();

        return Redirect::to('/dev-admin');
    }
}
