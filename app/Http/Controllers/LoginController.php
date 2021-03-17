<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $token_validity = 24 * 60;

        Auth::guard()->factory()->setTTL($token_validity);

        if (!$token = Auth::guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function auth(Request $req)
    {
        $dataUser = $req->input();

        $arraySend = array(
            'username' => $dataUser['email'],
            'password' => $dataUser['password']
        );

        $data = http_build_query($arraySend);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:5001/moviesDB");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        }else{
            $decode = json_decode($resp);
            foreach ($decode as $key => $value) {
                echo $key . ':' . $value;
            }
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 422);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function logout()
    {
        Auth::guard()->logout();

        return response()->json(['message' => 'User logged out successfully']);
    }

    public function profile()
    {
        return response()->json(Auth::guard()->user());
    }

    public function refresh()
    {
        return response()->json(Auth::guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'token_validity' => Auth::guard()->factory()->getTTL() * 60
        ]);
    }
}
