<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __counstruct()
    {
         $this->middleware('guest')->except('logout');
    }
   
    public function authView()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|alphaNum|min:4', // username must be only alhanumeric and greater then 4 symbols
            'password' => 'required|alphaNum|min:3' // password must be only alhanumeric and greater then 3 symbols
        );
        echo Hash::make('javhar12');

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
        }

        $credentials = $request->only('username', 'password');
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('login');
    }

}
