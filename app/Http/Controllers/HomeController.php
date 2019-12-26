<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware("auth");
	}

    public function home()
    {
    	return view("home");
    }

    public function update()
    {
    	request()->validate([
    		"email" => "required|email",
    		"password" => "required|confirmed|sometimes"
    	]);

    	$user = auth()->user();

    	$user->update([
    		"password" => bcrypt(request("password")),
    		"email" => request("email")
    	]);

    	return response()->json(true);
    }
}
