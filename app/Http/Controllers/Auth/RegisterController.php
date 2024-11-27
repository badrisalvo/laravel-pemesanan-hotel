<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya pengguna yang tidak terautentikasi yang dapat mengakses registrasi
        $this->middleware('guest');
    }

    /**
     * Validator untuk input data registrasi
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:10', 'max:15'], // Validasi untuk phone number
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address is already taken.',
            'phone.required' => 'The phone number is required.',
            'phone.min' => 'Phone number must be at least 10 characters.',
            'phone.max' => 'Phone number cannot exceed 15 characters.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);
    }

    /**
     * Buat user baru setelah validasi berhasil
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone'], // Menyimpan nomor telepon
            'password' => Hash::make($data['password']),
            'role' => 'customer', // Role otomatis menjadi customer
        ]);
    }

    /**
     * Handle registrasi dan login user setelah registrasi
     */
    public function register(Request $request)
    {
        // Validasi data registrasi
        $validator = $this->validator($request->all());
    
        // Jika validasi gagal, kembalikan respons JSON dengan error dan pesan kesalahan kustom
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            // Membuat array pesan kesalahan kustom
            $errorMessages = [];
    
            foreach ($errors->getMessages() as $field => $messages) {
                foreach ($messages as $message) {
                    // Menambahkan pesan kesalahan kustom untuk setiap field
                    $errorMessages[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }
    
            // Mengembalikan respons dengan kesalahan validasi
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errorMessages, // Menyertakan pesan kesalahan yang lebih terstruktur
            ], 422); // HTTP status code 422 untuk kesalahan validasi
        }
    
        // Jika validasi berhasil, buat pengguna baru
        $user = $this->create($request->all());
    
        // Autentikasi user setelah registrasi
        auth()->login($user);
    
        // Kembalikan respons sukses dengan data user
        return response()->json([
            'success' => true,
            'message' => 'Registration successful, and you are now logged in!',
            'user' => $user,
            'redirect_url' => url('/'),
        ]);
    }
}
