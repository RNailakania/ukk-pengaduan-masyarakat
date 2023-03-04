<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function _construct() {
        $this->middleware('auth', ['except'=>['login','register']]);
    }
    public function viewlogin() {
        return view('Auth.login');
    }

    public function viewregister() {
        return view('Auth.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('msg', 'Something Wrong');
        }
        return redirect("/dashboard")->with('success', 'User successfully Login');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|min:13',
            'nama' => 'required|string',
            'username' => 'required|string',
            'notlp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('msg', 'Something Wrong');
        }
        $user = User::create(array_merge(
           $validator->validated(),
           ['password'=>bcrypt($request->password)] 
        ));
        return redirect("auth/login")->with('success', 'User successfully Login');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect('auth/login');
    }
}
