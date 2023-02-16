<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //hapus token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        // jika logout berhasil
        if ($removeToken) {
            return response()->json([
                'status' => 200,
                'message' => 'berhasil logout!'
            ]);
        }
    }
}
