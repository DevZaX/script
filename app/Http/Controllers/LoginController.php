<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function home()
    {
    	return view("login");
    }

    public function login()
    {
    	request()->validate([
    		"email" => "required|email",
    		"password" => "required",
    	]);

    	if( Auth::attempt(["email" => request("email"),"password" => request("password")]) )
    	{
    		return response()->json(true);
    	}
    	else
    	{
    		return response(["message"=>"These credentials do not match our records."],500);
    	}	

    }

    public function logout()
    {
    	Auth::logout();
    	return back();
    }
}
