<?php

namespace App\Http\Controllers\Api\Auth;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return $this->failed([], 'Unauthorized', 401);
        }

        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        unset($user->roles);
        $responseData = [
            "user" => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'role' => $role
            ]
        ];
        return $this->success($responseData, 'User login successfully');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->failed($validator->errors()->all(), 'Validation failed', 400);
        }

        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole("student");


        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return $this->failed([], 'Unauthorized', 401);
        }

        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        unset($user->roles);
        $responseData = [
            "user" => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'role' => $role
            ]
        ];


        return $this->success($responseData, 'User registred successfully', 201);
    }

    public function logout()
    {
        Auth::logout();
        return $this->success([], 'Successfully logged out');
    }

    public function refresh()
    {

        $user = Auth::user();


        $refreshedToken = Auth::refresh();


        $responseData = [
            'user' => $user,
            'authorization' => [
                'token' => $refreshedToken,
                'type' => 'bearer',
            ]
        ];


        return $this->success($responseData);
    }
}
