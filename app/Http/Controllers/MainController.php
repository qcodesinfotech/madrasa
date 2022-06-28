<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function login()
    {
     return view('user.login');
    }

    function check(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:5|max:12'
        ]);

        $userInfo = User::where('phone', '=', $request->phone)->first();
        
        if (!$userInfo) {

            return back()->with('fail', 'We do not recognize your mobile NUmber');

        } else {
          
            if (Hash::check($request->password, $userInfo->password)) {

                $request->session()->put('LoggedUser', $userInfo->id);
             
                return redirect('/');

            }else{

                return back()->with('fail', 'Incorrect password');
           
            }
        }
    
    }


    function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }
}
