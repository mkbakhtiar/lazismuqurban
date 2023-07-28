<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PackagesController extends Controller
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
            $getProduct = DB::table('packages')->get();
            return DataTables::of($getProduct)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/paket/ubah/'.$row->id.'" class="edit btn btn-success btn-sm">Ubah</a> <a href="javascript:void(0)" class="edit btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target=".bs-modal-sm-delete" onclick="senderDataModal('.$row->id.',\''.$row->name.'\',\'Paket Kurban\',\'/paket/hapus\')">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('packages.index');
    }

    public function tambah() {
        return view('packages.tambah');
    }

    public function post(Request $request) {
        $this->validate($request, [
            'thumbnail' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'lots' => 'required',
            'description' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('thumbnail');

        $tujuan_upload = 'assets/images/paket/';
        $rename_file = "paket_qurban_lazismu_kota_malang_".str_replace(" ","_", $request->name).".".$file->getClientOriginalExtension();
	    $file->move($tujuan_upload,$rename_file);

        $insert = DB::table('packages')->insertGetId([
            'thumbnail' => $rename_file,
            'staf_id' => auth()->user()->id,
            'name' => $request->name,
            'price' => (int)str_replace(".","", $request->price),
            'unit' => $request->unit,
            'lots' => $request->lots,
            'description' => $request->description,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if($insert) {
            toastr()->success('Data paket berhasil ditambahkan!');

            return redirect('/paket');
        } else {
            toastr()->error('Data paket gagal ditambahkan!');
        }
    }

    public function ubah($id) {
        $getData = DB::table('packages')->where('id', $id)->first();
        $data = [
            'data' => $getData
        ];

        return view('packages.ubah')->with($data);
    }

    public function put(Request $request) {
        $getData = DB::table('packages')->where('id', $request->id)->first();

        $file = $request->file('thumbnail');

        if($file) {
            $tujuan_upload = 'assets/images/paket/';
            $rename_file = "paket_qurban_lazismu_kota_malang_".str_replace(" ","_", $request->name).".".$file->getClientOriginalExtension();
            $upload = $file->move($tujuan_upload,$rename_file);

            if($upload) {
                $this->removeImageFile('assets/images/paket/'.$getData->thumbnail);
            }
        }

        $arrayUpdate = [
            'name' => $request->name,
            'price' => (int)str_replace(".","", $request->price),
            'unit' => $request->unit,
            'lots' => $request->lots,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if($file) {
           $arrayUpdate += ['thumbnail' => $rename_file];
        }

        $update = DB::table('packages')->where('id', $request->id)->update($arrayUpdate);

        if($update) {
            toastr()->success('Data paket berhasil diubah!');
            return redirect('/paket');
        } else {
            toastr()->error('Data paket gagal diubah!');
            return redirect('/paket');
        }

    }

    public function removeImageFile($url) {
        unlink($url);
    }

    public function hapus(Request $request) {
        $id = $request->id;
        $getData = DB::table('packages')->where('id', $id)->first();
        $this->removeImageFile('assets/images/paket/'.$getData->thumbnail);

        $delete = DB::table('packages')->where('id', $id)->delete();

        if($delete) {
            toastr()->success('Data paket berhasil dihapus!');
            return redirect('/paket');
        } else {
            toastr()->error('Data paket gagal dihapus!');
            return redirect('/paket');
        }
    }


}
