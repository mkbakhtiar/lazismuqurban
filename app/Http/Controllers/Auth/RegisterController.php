<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required'],
            'pdm_id' => ['required'],
            'handphone' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Silahkan mengisi nama lengkap.',
            'pdm_id.required' => 'Silahkan mengisi wilayah.',
            'handphone.required' => 'Silahkan mengisi nomor WA.',
            'handphone.unique' => 'Nomor handphone sudah terdaftar.',
            'password.required' => 'Silahkan mengisi password.',
            'password.confirmed' => 'Password yang anda masukan tidak sama.',
            'password.min' => 'Password yang anda masukan harus lebih dari :min',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'handphone' => $data['handphone'],
            'pdm_id' => $data['pdm_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
