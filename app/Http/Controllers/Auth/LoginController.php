<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        // Jika validasi gagal
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = [];
    
            foreach ($errors->getMessages() as $field => $messages) {
                foreach ($messages as $message) {
                    $errorMessages[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errorMessages,
            ], 422);
        }
    
        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found.',
                'errors' => [
                    ['field' => 'email', 'message' => 'Email salah atau tidak terdaftar!']
                ],
            ], 404);
        }
    
        // Cek apakah password cocok
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect password.',
                'errors' => [
                    ['field' => 'password', 'message' => 'Wrong Password!']
                ],
            ], 401);
        }
    
        // Jika autentikasi berhasil
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => true,
                'message' => 'Login success!',
                'user' => [
                            'name' => Auth::user()->name,
                            'email' => Auth::user()->email,
                            'role' => Auth::user()->role, // Include role in the response
                        ],
            ]);
        }
    
        // Jika gagal autentikasi (Fallback, meskipun tidak seharusnya tercapai)
        return response()->json([
            'success' => false,
            'message' => 'Login failed due to unknown error.',
        ], 500);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');;
    }
}
