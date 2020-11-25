<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function getProfile($id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                "error" => "User Not Found"
            ],404);
        }

        return response()->json([
            "user" => [
                "userId" => $user->id,
                "fullname" => $user->fullname,
                "email" => $user->email,
                "contact" => $user->contact,
                "profile" => $user->profile
            ]
        ],200);
    }

    public function editProfile(Request $request,$id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                "error" => "User Not Found"
            ],404);
        }

        $find = User::where('email',$request->input('email'))->first();
        
        if($find && $find->id != $user->id){
            return response()->json([
                "error" => "Email already in use",
            ],403);
        }

        $user->fullname = $request->input('fullName');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->profile = $request->input('profile');
        $user->save();


        return response()->json([
            "msg" => "Successfully updated profile",
            "user" => [
                "userId" => $user->id,
                "fullname" => $user->fullname,
                "email" => $user->email,
                "contact" => $user->contact,
                "profile" => $user->profile
            ]
        ],200);
    }
}
