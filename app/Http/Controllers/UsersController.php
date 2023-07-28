<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Yajra\Datatables\Datatables;
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
            'pdm_id' => ['required'],
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

    public function registerValidate(Request $request) {
        $this->validator($request->all())->validate();

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : new JsonResponse([
                'data' => 'Data Anda valid, silahkan isi kode OTP yang sudah dikirimkan ke nomor WA '. $request->handphone,
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
        $sender_wa = SenderWA::send_otp($wa, $FourDigitRandomNumber);
        return $sender_wa;

    }

public function index(Request $request)
    {
        if ($request->ajax()) {
            $getProduct = DB::table('users')->get();
            return DataTables::of($getProduct)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/petugas/ubah/'.$row->id.'" class="edit btn btn-success btn-sm">Ubah</a> <a href="javascript:void(0)" class="edit btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target=".bs-modal-sm-delete" onclick="senderDataModal('.$row->id.',\''.$row->name.'\',\'Petugas\',\'/petugas/hapus\')">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('staf.index');
    }

    public function tambah(){
        $wilayah_pdm = DB::table('pdm')->get();

        $data = [
            'wilayah' => $wilayah_pdm
        ];

        return view('staf.tambah')->with($data);
    }

    public function post(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'handphone' => 'required|unique:users',
            'password' => 'required',
            'pdm_id' => 'required',
        ]);

        $insert = DB::table('users')->insertGetId([
            'name' => $request->name,
            'handphone' => $request->handphone,
            'pdm_id' => $request->pdm_id,
            'password' => Hash::make($request->password),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if($insert) {
            return new JsonResponse([
                'data' => [],
                'success' => true
            ], 200);
        } else {
            return new JsonResponse([
                'message' => 'Gagal menambah petugas',
                'success' => false
            ], 400);
        }
    }

    public function ubah($id){
        $getData = DB::table('users')->where('id', $id)->first();
        $wilayah_pdm = DB::table('pdm')->get();
        $data = [
            'data' => $getData,
            'wilayah' => $wilayah_pdm,
        ];

        return view('staf.ubah')->with($data);
    }

    public function put(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'pdm_id' => 'required',
            'handphone' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($request->id)],
        ]);

        $updateArray = [
            'name' => $request->name,
            'pdm_id' => $request->pdm_id,
            'handphone' => $request->handphone,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if($request->password) {
           $updateArray += ['password' => Hash::make($request->password)];
        }

        $insert = DB::table('users')->where('id', $request->id)->update($updateArray);

        if($insert) {
            return new JsonResponse([
                'data' => [],
                'success' => true
            ], 200);
        } else {
            return new JsonResponse([
                'message' => 'Gagal mengubah petugas',
                'success' => false
            ], 400);
        }
    }

    public function hapus(Request $request) {
        $id = $request->id;
        $delete = DB::table('users')->where('id', $id)->delete();

        if($delete) {
            toastr()->success('Data petugas berhasil dihapus!');
            return redirect('/petugas');
        } else {
            toastr()->error('Data petugas gagal dihapus!');
            return redirect('/petugas');
        }
    }

}


