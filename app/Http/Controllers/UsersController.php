<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\SenderWA;

class UsersController extends Controller
{
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
            'handphone' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Silahkan mengisi nama lengkap.',
            'handphone.required' => 'Silahkan mengisi nomor WA.',
            'handphone.unique' => 'Nomor handphone sudah terdaftar.',
            'password.required' => 'Silahkan mengisi password.',
            'password.confirmed' => 'Password yang anda masukan tidak sama.',
            'password.min' => 'Password yang anda masukan harus lebih dari :min',
        ]);
    }

    public function registerValidate(Request $request) {
        $this->validator($request->all())->validate();

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : new JsonResponse([
                'data' => 'Data Anda falid, silahkan isi kode OTP yang sudah dikirimkan ke nomor WA '. $request->handphone,
                'success' => true
            ], 200);
    }

    public function numberWAValidate($wa) {
        $validate_number_wa = SenderWA::validate_number_wa($wa);
        return $validate_number_wa;
    }

    public function sendOTP($wa) {
        // random 4 digit number
        $FourDigitRandomNumber = mt_rand(1111,9999);
        // set session
        session()->put('otp_code', $FourDigitRandomNumber);
        session()->put('otp_code_time', strtotime(date("Y-m-d H:i:s")));
        // send otp
        $sender_wa = SenderWA::send_wa($wa, $FourDigitRandomNumber);
        return $sender_wa;

    }
}
