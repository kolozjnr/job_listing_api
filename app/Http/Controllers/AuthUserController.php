<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
class AuthUserController extends Controller
{
        public $successStatus = 200;
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
       
        //$input = $request->all(); 
                //ddd($input);
                //$input['fname'] = $input['fname'];
                //$input['password'] = bcrypt($input['password']); 
                $user = User::create([
                        'fname' => $request->input('fname'),
                        'lname' => $request->input('lname'),
                        'email' => $request->input('email'),
                        'tel' => $request->input('tel'),
                        'state' => $request->input('state'),
                        'address' => $request->input('address'),
                        'company_name' => $request->input('company_name'),
                        'logo' => $request->input('logo'),
                        'user_type' => $request->input('user_type'),
                        'password' => bcrypt($request->input('password')),
                ]); 
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                $success['fname'] =  $user->fname;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }

    //User login API

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    

    //get login user api

    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 


    
}
