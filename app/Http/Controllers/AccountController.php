<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
    	$this->middleware("auth");
    }

    public function home()
    {
    	return view("accounts");
    }

    public function saveAccount(Account $account)
    {
    	request()->validate([
    		"name" => "required",
    		"key" => "required",
    		"secret" => "required",
    	]);

    	$account->create([
    		"name" => request("name"),
    		"key" => request("key"),
    		"secret" => request("secret"),
    		"token" => request("token"),
    	]);

    	return response()->json(true);
    }


    public function getAccounts(Account $account)
    {
        return response()->json($account->orderBy("id","desc")->get());
    }

    public function deleteAccount($id,Account $account)
    {
        $account = $account->find($id)->delete();
    }

    public function updateAccount($id,Account $account)
    {
        request()->validate([
            "name" => "required",
            "key" => "required",
            "secret" => "required",
        ]);

        $account->find($id)->update([
            "name" => request("name"),
            "key" => request("key"),
            "secret" => request("secret"),
            "token" => request("token"),
        ]);

        return response()->json(true);
    }
}
