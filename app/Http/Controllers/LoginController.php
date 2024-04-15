<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                404
            );
        }
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'the provided crdentials are incorrect',
            ], 422);
        }
        // $device=substr($request->userAgent() ?? '',0,255);
        // return $device;
        $token = $user->createToken('apiToken')->plainTextToken;
        // return $token;
        return response()->json([
            // 'access_token'=>$user->createToken($user)->plainTextToken,
            'access_token' => $token,
        ], 200);
    }
}
