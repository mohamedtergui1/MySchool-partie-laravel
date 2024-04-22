<?php

namespace App\Http\Controllers\Api\Auth;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgot', 'reset']]);
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

        $responseData = [
            "user" => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'role' => $user->role_id
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
            'role_id' => 1
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

        return $this->success($refreshedToken);
    }

    public function forgot()
    {
        request()->validate(['email' => 'required|email|exists:users']);
        $token = Str::random(64);

        $email = request('email');
        DB::table('password_reset_tokens')->where("email", $email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $credentials = [
            'token' => $token,
            'email' => $email
        ];

        Mail::send('email.forgetPassword', ['credentials' => $credentials], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password');
        });

        return response()->json(['message' => 'check your email']);
    }

    public function reset()
    {
        request()->validate([
            'password' => 'required|string|min:6'
            // ,
            // 'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => request('email'),
                'token' => request('token')
            ])
            ->first();

        if (!$updatePassword) {
            return $this->failed([], "Invalid token!");
        }

        $user = $this->userRepository->getByEmail(request('email'))
            ->update(['password' => Hash::make(request('password'))]);

        DB::table('password_reset_tokens')->where('email', request('email'))->delete();

        return $this->success('Your password has been changed!');
    }


}
