<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // validasi
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed'
            ]
        );

        // jika validasi gagal
        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        // jika validasi berhasil maka simpan user ke db
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // jika sukses return response json
        if ($user) {
            return response()->json([
                'status' => 201,
                'message' => 'registrasi berhasil!',
                'data' => $user,
            ]);
        }

        // jika gagal insert ke db
        return response()->json([
            'status' => 409,
            'message' => 'registrasi gagal!',
            'data' => $user,
        ]);
    }
}
