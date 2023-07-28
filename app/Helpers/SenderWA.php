<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class SenderWA {
    public static function validate_number_wa($phone_no) {
       $dataSending = Array();
        $dataSending["api_key"] = env('API_KEY_WATZAP');
        $dataSending["number_key"] = env('NUMBER_KEY_WATZAP');
        $dataSending["phone_no"] = $phone_no;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.watzap.id/v1/validate_number',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataSending),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function send_otp($phone_no, $code) {
        $dataSending = Array();
        $dataSending["api_key"] = env('API_KEY_WATZAP');
        $dataSending["number_key"] = env('NUMBER_KEY_WATZAP');
        $dataSending["phone_no"] = $phone_no;
        $dataSending["message"] = "*".$code."* adalah kode OTP untuk masuk ke akun Lazismu. Kode ini akan valid selama 2 menit. KODE INI BERSIFAT RAHASIA. JANGAN DIBERITAHU SIAPAPUN.";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    public static function send_notif_wa($phone_no, $desc) {
        $dataSending = Array();
        $dataSending["api_key"] = env('API_KEY_WATZAP');
        $dataSending["number_key"] = env('NUMBER_KEY_WATZAP');
        $dataSending["phone_no"] = $phone_no;
        $dataSending["message"] = $desc;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }
    public static function send_notif_wa_image($phone_no, $desc, $thumbnail) {
        $dataSending = Array();
        $dataSending["api_key"] = env('API_KEY_WATZAP');
        $dataSending["number_key"] = env('NUMBER_KEY_WATZAP');
        $dataSending["phone_no"] = $phone_no;
        $dataSending["message"] = urldecode($desc);
        $dataSending["url"] = $thumbnail;
        $dataSending["separate_caption"] = "0";

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_image_url',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }
}
