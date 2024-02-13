<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function register(Request $request){
         
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        try {
             
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);  
    
    
            $user->save();
    
             
            auth()->login($user);
    
            
            return response()->json(["success" => "User registered successfully"]);
    
        } catch (\Exception $e) {
            // If an exception occurs during signup, return an error response
            return response()->json(["error" => "Failed to register user. Please try again later."]);
        }
    }
    
    
    public function login(Request $request){
        $user = User::where("email", $request->email)->first();
        
        if($user){
            if(password_verify($request->password, $user->password)){
                // $request->session()->put('user', [
                //     "id" => $user->id,
                //     "email" => $user->email,
                //     "name" => $user->name
                // ]);
                return response()->json(["success" => "login success", "user" => [
                    "id" => $user->id,
                    "email" => $user->email,
                    "name" => $user->name
                ]]);
            } else {
                return response()->json(["error" => "wrong password"]);
            }
        } else {
            return response()->json(["error" => "wrong email"]);
        }
        
    }
    
}
