<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function __invoke(Request $request) {
        // Set validasi
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        // Jika validasi gagal
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // ambil credential dari request
        $credentials = $request->only('username', 'password');

        // jika auth gagal
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau Password Anda Salah'
            ], 401);
        }

        // jika auth berhasil
            return response()->json([
                'success' => true,
                'message' => auth()->guard('api')->user(),
                'token' => $token
            ], 200);
    }
}
