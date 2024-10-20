<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            "loginemail" =>"required",
            "loginpassword" => "required",
        ]);

        if(auth()->attempt(['email'=>$incomingFields['loginemail'], 'password'=>$incomingFields['loginpassword'] ])) {
            $request->session()->regenerate();

            if (auth()->user()->admin === 0) {
                return redirect('/apply');
                
            }
            else {
                return redirect('/admin-crud');
            }
        };
    }
    
    public function logout(){
        auth()->logout();
        return redirect("/");
    }
    
    public function register(Request $request) {
        $incomingFields = $request -> validate([
            "name" => ["required", Rule::unique('users', 'name')],
            "email"=> ["required",'email', Rule::unique('users', 'email')],
            "password"=> "required",
            "phone" => "required",
        ]);

        $incomingFields["password"] = bcrypt($request->password); // encrypt passwords in database

        $user = User::create($incomingFields);
        auth()->login($user);
        
        return redirect("/"); //go to page to apply since you are registed
    } 
}