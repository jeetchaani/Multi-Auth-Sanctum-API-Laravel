<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //admin login api
     public function login(Request $request) {
           
              //check validation 
              $validator=Validator::make($request->all(),[
                  'email'=>'required|email',
                   'password'=>'required'
              ]);
                if($validator->fails()){
                    return jsonResponse(false,$validator->errors(),422);
                }
                elseif (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                       
                    $user=Auth::guard('admin')->user();
                    $token = $user->createToken('AdminToken', ['admin'])->plainTextToken;
                    $message=[
                        'user'=>$user,
                         'token'=>$token
                    ];

                    return jsonResponse(true,$message,200);

                } else{
                     $message="Invalid Email or Password";
                     return jsonResponse(false,$message,401);
                }

     }
     public function logout(){
        //post request
        auth()->user()->tokens()->delete();
        return jsonResponse(true,"logout successfully",200);
     }

     
}
