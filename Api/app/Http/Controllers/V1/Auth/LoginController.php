<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //validasi
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        // jika validasi gagal
        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        // ambil credential dari request
        $credentials = $request->only('email', 'password');

        // jika auth gagal
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'message' => 'email atau password anda salah'
            ]);
        }

        // jika auth berhasil
        return response()->json([
            'status' => 200,
            'message' => 'login berhasil',
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ]);
    }
}
