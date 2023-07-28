<?php

namespace App\Http\Controllers;

use App\Helpers\SenderWA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index() {
        $getPaket = DB::table('packages')->get();
        $data = [
            'paket' => $getPaket
        ];

        return view('web.home.index')->with($data);
    }
    public function detail($url) {
        $urlRpl = str_replace("-"," ", $url);
        $paket = DB::table('packages')->where('name', $urlRpl)->first();
        return view('web.home.detail')->with(['paket' => $paket]);
    }
    public function order(Request $request){
        $paket = DB::table('packages')->where('id', $request->packages_id)->first();

        $validate_number_wa = SenderWA::validate_number_wa($request->customer_phone);

        if(!$validate_number_wa) {
            toastr()->error('Nomor yang Anda masukan bukan nomor WA');
            $roll = [
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'nominal' => $request->nominal,
                'qty' => $request->qty,
            ];
            return redirect('/paket/lazismu-kota-malang/'.strtolower(str_replace(" ","-",$paket->name)))->with($roll);
        }

        $insert = DB::table('transaction')->insertGetId([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_nik' => "",
            'customer_address' => $request->customer_address,
            'packages_id' => $request->packages_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'nominal' => $request->nominal,
            'transaction_date' => date("Y-m-d H:i:s"),
            'qty' => $request->qty,
            'satuan' => "",
            'staf_id' => 0,
            'description' => "",
            'is_delete' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $pathThumbnail = env('APP_URL').'/assets/images/paket/'.$paket->thumbnail;

        $sender = SenderWA::send_notif_wa_image($request->customer_phone, 'Assalamualaikum ' .
                    $request->customer_name .
                    ',%0A' .
                    'Terimakasih telah melakukan transaksi di Lazismu Kota Malang dengan Paket '.
                    '*' .$paket->name.
                    '* sebanyak *'. $request->qty .' Item* .%0A %0A' .
                    'Berikut tagihan yang harus Anda bayar.' .
                    '%0A %0A' .
                    'Nominal : Rp' .
                    number_format($request->nominal, 0, ',', '.') .
                    '%0A' .
                    'Status : Menunggu Pebayaran' .
                    '%0A%0A' .
                    'Silahkan Selesaikan Kebaikan Anda Melalui' .
                    '%0A' .
                    '1111867346' .
                    '%0A' .
                    'a.n BSI - a.n Yayasan Dana Lazismu Kota Malang' .
                    '%0A%0AKirimkan Bukti Pembayaran Dengan Membalas Pesan Ini' .
                    '%0A %0A Salam Hangat' .
                    '%0A' .
                    'LAZISMU KOTA MALANG', $pathThumbnail);

        return redirect('/order-success/'.base64_encode($insert));

    }
    public function success($enc) {
        $getTransaction = DB::table('transaction')->where('id', base64_decode($enc))->first();
        $getPaket = DB::table('packages')->where('id', $getTransaction->packages_id)->first();

        $data = [
            'paket' => $getPaket,
            'transaksi' => $getTransaction,
        ];

        return view('web.home.success')->with($data);

    }
}
