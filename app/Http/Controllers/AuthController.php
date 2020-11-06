<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Database\ModalNotFoundException;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


use App\Models\User;
use App\Mail\SuccessfullyRegistered;
use App\Mail\RequestOTP;
use App\Mail\PasswordChanged;

class AuthController extends Controller
{
    public function register(Request $request){
        try{
            $user = User::create([
                "fullname" => $request->input('fullname'),
                "email" => $request->input('email'),
                "contact" => $request->input('contact'),
                "password" => Hash::make($request->input('password'))
            ]);
        }
        catch(QueryException $e){
            return response()->json([
                "error" => $e
            ],403);
        }

        Mail::to($user->email)->send(new SuccessfullyRegistered($user));

        return response()->json([
            "msg" => "Successfully Registered",
            "user" => [
                "userId" => $user->id,
                "fullname" => $user->fullname,
                "email" => $user->email,
                "contact" => $user->contact
            ]
        ],200);   
             
    }

    public function login(Request $request){
        
        $user = User::where('email',$request->input('email'))->first();
        if(!$user){
            return response()->json([
                "error" => "Account not found"
            ],404);
        }

        if(Hash::check($request->input('password'),$user->password)){
            return response()->json([
                "msg" => "Successfully Logged in",
                "user" => [
                    "userId" => $user->id,
                    "fullname" => $user->fullname,
                    "email" => $user->email,
                    "contact" => $user->contact
                ]
            ],200);
        }else{
            return response()->json(["error" => "Password incorrect"],401);
        }

    }

    public function requestOTP(Request $request){

        $user = User::where('email',$request->input('email'))->first();
        if(!$user){
            return response()->json([
                "error" => "Account not found"
            ],404);
        }

        $otp = rand(100000,999999);
        $time = now()->toDateTimeString();

        Mail::to($user->email)->send(new RequestOTP($user,$otp,$time));

        return response()->json([
            "otp" => $otp,
        ],200);
    }

    public function resetPassword(Request $request){

        $user = User::where('email',$request->input('email'))->first();
        if(!$user){
            return response()->json([
                "error" => "Account not found"
            ],404);
        }

        $newPassword = $request->input('newPassword');
        if(Hash::check($newPassword,$user->password)){
            return response()->json([
                "error" => "New Password cannot be same as Old Password"
            ],403);
        }

        $user->password = Hash::make($newPassword);
        $user->save();
        $time = now()->toDateTimeString();
        Mail::to($user->email)->send(new PasswordChanged($user,$time));
        return response()->json([
            "msg" => "Successfully updated password"
        ],200);
    }
}
