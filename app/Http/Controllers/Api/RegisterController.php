<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __invoke(Request $request) {
        // Set validator
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required|min:5|confirmed',
            'level_id' => 'required',
            'image' => 'required'
        ]);

        // if validasi gagal
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create User
        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->input('password')),
            'level_id' => $request->level_id,
            'image' => $request->image->hashName(),
        ]);

        // Return response JSON is created
        if($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ]);
        }

        // Return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);
    }
}
