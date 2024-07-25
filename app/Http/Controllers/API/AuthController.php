<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Tambahkan ini

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email'=>'required|email',
            'password'=> 'required',
        ]);

        $user = User::where('email',$loginData['email'])->first();
        //check user exist
        if(!$user){
            \Log::error('User not found'); // Tambahkan logging untuk debugging
            return respose(['message'=>'Invalid credentials'],401);
        }

        //Check password
        if (!Hash::check($loginData['password'],$user->password))
        {
            \Log::error('Password Error'); // Tambahkan logging untuk debugging
            return response(['message' =>'Invalid credentials'],401);
        }

        //$token = $user->createToken('auth_token')->plainTextToken;
        //return response(['user' => $user,'token'=> $token],200);

        $token = $user->createToken('auth_token')->plainTextToken;
        \Log::info('Login successful'); // Tambahkan logging untuk debugging
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    //Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['message'=>'Logged Out'],200);
    }

     //update image profile & face_embedding
     public function updateProfile(Request $request)
     {
         $request->validate([
             'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
             'face_embedding' => 'required',
         ]);

         $user = $request->user();
         $image = $request->file('image');
         $face_embedding = $request->face_embedding;

         //save image
         $image->storeAs('public/images', $image->hashName());
         $user->image_url = $image->hashName();
         $user->face_embedding = $face_embedding;
         $user->save();

         return response([
             'message' => 'Profile updated',
             'user' => $user,
         ], 200);
     }
}
