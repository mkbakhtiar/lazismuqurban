<?php

namespace App\Http\Controllers;

use App\Helpers\SenderWA;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->startdate !== null && $request->enddate !== null) {
                $start = date_format(date_create($request->startdate.' 00:00:00'), 'Y-m-d H:i:s');
                $end = date_format(date_create($request->enddate.' 23:59:59'), 'Y-m-d H:i:s');

                $getProduct = DB::select("select `transaction`.*, `packages`.`name` as `packages_name` from `transaction` inner join `packages` on `transaction`.`packages_id` = `packages`.`id` where `transaction`.`transaction_date` between '".$start."' and '".$end."' and `transaction`.`is_delete` <> 1");
            } else {
                $getProduct = DB::table('transaction')
                ->select('transaction.*','packages.name as packages_name')
                ->join('packages','transaction.packages_id','=','packages.id')
                ->where('transaction.is_delete', '<>', 1)
                ->get();
            }

            return DataTables::of($getProduct)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $nominal = number_format($row->nominal, 0, ",", ".");
                    $confirmButton = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bs-modal-sm-delete" onclick="senderDataModal('.$row->id.',\'Apakah Anda Yakin Akan Mengkonfirmasi Pembayaran Sebesar Rp '. $nominal .' Atas Nama '.$row->customer_name.'\',\'Konfirmasi Pembayaran\',\'/qurban/confirm\')">Konfirmasi</a>';
                    $confirmed = '<button class="edit btn btn-primary btn-sm" disabled>Dikonfirmasi</button>';
                    $actionBtn = '&nbsp;<a href="/qurban/ubah/'.$row->id.'" class="edit btn btn-success btn-sm">Ubah</a> &nbsp; <a href="javascript:void(0)" class="edit btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target=".bs-modal-sm-delete" onclick="senderDataModal('.$row->id.',\''.$row->customer_name.'\',\'Transaksi Kurban\',\'/qurban/hapus\')">Hapus</a>';
                    return $row->is_confirm !== 1 ? $confirmButton." ".$actionBtn : $confirmed." ".$actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('transaction.qurban.index');
    }
    public function tambah() {
        return view('transaction.qurban.tambah');
    }
    public function post(Request $request) {
        
        $paket = DB::table('packages')->where('id', $request->packages_id)->first();

        $customer_name = $request->customer_name;
        $customer_phone = $request->customer_phone;
        $customer_nik = $request->customer_nik;
        $customer_address = $request->customer_address;
        $packages_id = $request->packages_id;
        $nominal = $request->nominal;
        $transaction_date = $request->transaction_date;
        $qty = $request->qty;
        $unit = $request->unit;
        $staf_id = $request->staf_id;
        $description = $request->description;


        $validate_number_wa = SenderWA::validate_number_wa($customer_phone);
        if(!$validate_number_wa) {
            return new JsonResponse([
                'data' => 'Nomor yang anda masukan bukan nomor WA!',
                'success' => false
            ], 400);
        }

        $this->validate($request, [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_nik' => 'required',
            'customer_address' => 'required',
            'packages_id' => 'required',
            'nominal' => 'required',
            'transaction_date' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'staf_id' => 'required',
            'description' => 'required',
        ]);

        $insert = DB::table('transaction')->insertGetId([
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'customer_nik' => $customer_nik,
            'customer_address' => $customer_address,
            'packages_id' => $packages_id,
            'nominal' => $nominal,
            'transaction_date' => $transaction_date,
            'qty' => $qty,
            'satuan' => $unit,
            'staf_id' => $staf_id,
            'description' => $description,
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

        if($insert) {
            return new JsonResponse([
                'data' => 'Transaksi berhasil ditambahkan!',
                'success' => true
            ], 200);
        } else {
            return new JsonResponse([
                'data' => 'Transaksi gagal ditambahkan!',
                'success' => false
            ], 400);
        }


    }
    public function ubah($id) {
        $getTransactionSelected = DB::table('transaction')->where('id', $id)->first();
        $getPaketSelected = DB::table('packages')->where('id', $getTransactionSelected->packages_id)->first();
        $getStafSelected = DB::table('users')->where('id', $getTransactionSelected->staf_id)->first();
        $data = [
            'transaction' => $getTransactionSelected,
            'packages' => $getPaketSelected,
            'staf' => $getStafSelected,
            'type' => 'ubah',
        ];

        return view('transaction.qurban.ubah')->with($data);
    }
    public function detail($id) {
        $getTransactionSelected = DB::table('transaction')->where('id', $id)->first();
        $getPaketSelected = DB::table('packages')->where('id', $getTransactionSelected->packages_id)->first();
        $getStafSelected = DB::table('users')->where('id', $getTransactionSelected->staf_id)->first();
        $data = [
            'transaction' => $getTransactionSelected,
            'packages' => $getPaketSelected,
            'staf' => $getStafSelected,
            'type' => 'detail',
        ];

        return view('transaction.qurban.ubah')->with($data);
    }
    public function put(Request $request) {
        $customer_name = $request->customer_name;
        $customer_phone = $request->customer_phone;
        $customer_nik = $request->customer_nik;
        $customer_address = $request->customer_address;
        $packages_id = $request->packages_id;
        $nominal = $request->nominal;
        $transaction_date = $request->transaction_date;
        $qty = $request->qty;
        $unit = $request->unit;
        $staf_id = $request->staf_id;
        $description = $request->description;


        $validate_number_wa = SenderWA::validate_number_wa($customer_phone);
        if(!$validate_number_wa) {
            return new JsonResponse([
                'data' => 'Nomor yang anda masukan bukan nomor WA!',
                'success' => false
            ], 400);
        }

        $this->validate($request, [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_nik' => 'required',
            'customer_address' => 'required',
            'packages_id' => 'required',
            'nominal' => 'required',
            'transaction_date' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'staf_id' => 'required',
            'description' => 'required',
        ]);

        $insert = DB::table('transaction')->where('id', $request->id)->update([
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'customer_nik' => $customer_nik,
            'customer_address' => $customer_address,
            'packages_id' => $packages_id,
            'nominal' => $nominal,
            'transaction_date' => $transaction_date,
            'qty' => $qty,
            'satuan' => $unit,
            'staf_id' => $staf_id,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if($insert) {
            return new JsonResponse([
                'data' => 'Transaksi berhasil diubah!',
                'success' => true
            ], 200);
        } else {
            return new JsonResponse([
                'data' => 'Transaksi gagal diubah!',
                'success' => false
            ], 400);
        }


    }

    public function hapus(Request $request) {
        $insert = DB::table('transaction')->where('id', $request->id)->update([
                'is_delete' => 1,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);

            if($insert) {
                toastr()->success('Berhasil menghapus transaksi');
                return redirect('/qurban');
            } else {
                toastr()->error('Gagal menghapus transaksi');
                return redirect('/qurban');
            }
    }

    public function confirm(Request $request) {
        $insert = DB::table('transaction')->where('id', $request->id)->update([
            'is_confirm' => 1,
            'confirm_at' => date('Y-m-d H:i:s'),
        ]);

        $getDataTransaction = DB::table('transaction')->where('id', $request->id)->first();

        $sender = SenderWA::send_notif_wa_image($getDataTransaction->customer_phone, "Assalamualaikum Wr. Wb %0AJazakallah Khair Saudara/i *". $getDataTransaction->customer_name. "* pembayaran Anda Sebesar *Rp". number_format($getDataTransaction->nominal, 0, ',', '.') ."* telah di konfirmasi. %0A %0A %0A_Maka shalatlah kamu untuk Rabbmu dan sembelihlah hewan kurban (QS. Al Kautsar: 2)_","https://cdn.dribbble.com/users/411286/screenshots/2619563/desktop_copy.png");

        if($insert) {
            toastr()->success('Berhasil mengkonfirmasi pembayaran');
            return redirect('/qurban');
        } else {
            toastr()->error('Gagal mengkonfirmasi pembayaran');
            return redirect('/qurban');
        }
    }

}
