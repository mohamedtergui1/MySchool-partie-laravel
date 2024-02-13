<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {



        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(["success" => false, "errors" => $validator->errors()]);
            }


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);


            $user->save();

            return response()->json(["success" => "User registered successfully"]);

        } catch (\Exception $e) {

            return response()->json(["error" => "Failed to register user. Please try again later."]);
        }


        return response()->json(["success" => true]);



    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(["success" => false, "errors" => $validator->errors()]);
        }

        $user = User::where("email", $request->email)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {

                return response()->json([
                    "success" => "login success",
                    "user" => [
                        "id" => $user->id,
                        "email" => $user->email,
                        "name" => $user->name
                    ]
                ]);

            } else {
                return response()->json(["error" => "wrong password"]);

            }
        } else {

            return response()->json(["error" => "wrong email"]);

        }

    }

}
