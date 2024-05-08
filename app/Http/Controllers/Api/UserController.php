<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index() {
        return UserModel::all();
    }

    public function store(Request $request)
{
    // Mengambil data dari request
    $userData = $request->all();

    // Mengenkripsi password
    $userData['password'] = bcrypt($request->password);

    // Membuat instance UserModel dan menyimpannya
    $user = UserModel::create($userData);

    // Memberikan respons JSON
    return response()->json($user, 201);
}


    public function show(UserModel $user)
    {
        return UserModel::find($user);
    }

    public function update(Request $request, UserModel $user)
    {
        $user->update($request->all());
        return UserModel::find($user);
    }

    public function destroy(UserModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
