<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class BedController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function list(Request $request)
    {

        // if ($request->ajax()) {
        //     $getMutasi = DB::table('d_mutasi_siswa as dms')
        //         ->leftJoin('d_siswa as ds', 'ds.id_siswa', '=', 'dms.id_siswa')
        //         ->select('dms.*', 'ds.nama', 'ds.nis', 'ds.jenis_kelamin', 'ds.status', DB::raw("'0' as temporary"))
        //         ->orderByDesc('dms.id_mutasi_siswa');

        //     if($roleByJk != 'all'){
        //         // $getMutasi->where('ds.jenis_kelamin', $roleByJk);
        //     }
        //     $getMutasi = $getMutasi->get();

        //     $getMutasiTemporary = DB::table('d_mutasi_siswa_temporary as dmst')
        //         ->select('dmst.*', 'dmst.nama_siswa as nama', DB::raw("'' as nis"), DB::raw("'' as status"), DB::raw("'1' as temporary"))
        //         ->whereNull('dmst.deleted_at')
        //         ->orderByDesc('dmst.id_mutasi_siswa_temporary');

        //     if($roleByJk != 'all'){
        //         // $getMutasiTemporary->where('dmst.jenis_kelamin', $roleByJk);
        //     }
        //     $getMutasiTemporary = $getMutasiTemporary->get();

        //     $dataMutasi = $getMutasiTemporary->merge($getMutasi);

        //     return Datatables::of($dataMutasi)
        //         ->addIndexColumn()
        //         ->editColumn('tanggal_mutasi', function ($data){
        //             if(!$data->tanggal_mutasi){
        //                 return '-';
        //             } else {
        //                 return Carbon::parse($data->tanggal_mutasi)->translatedFormat('d F Y');
        //             }
        //         })
        //         ->addColumn('action', function($row){
        //             return '';
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        return view('bed.list');
    }
}
