<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    function password(Request $request)
    {
        $password = $request->password;
        $newpassword = $request->newpassword;
        $repassword = $request->repassword;

        if ($newpassword == $repassword) {
            $user = Auth::user();
            if (!password_verify($request->password, $user->password)) {
                return response()->json("パスワードが違います");
            } else {
                $id = Auth::id();
                $user = User::where('id', $id)->first();
                $user->password = bcrypt($request->newpassword);
                $user->save();
                return response()->json("パスワードを変更しました!");
            }
        } else {
            return response()->json("", 500);
        }
    }
}
