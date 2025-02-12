<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Spipu\Html2Pdf\Html2Pdf;
use PDF;

class SuratController extends Controller
{
    public function __construct()
    {
        
    } 

    public function index(Request $request)
    {
        $roleByJk = 'all';
        if(!in_array(session('group_sequence'), [1])){
            $roleByJk = session('gender');
        } 

        if ($request->ajax()) {
            $getMutasi = DB::table('d_mutasi_siswa as dms')
                ->leftJoin('d_siswa as ds', 'ds.id_siswa', '=', 'dms.id_siswa')
                ->select('dms.*', 'ds.nama', 'ds.nis', 'ds.jenis_kelamin', 'ds.status', DB::raw("'0' as temporary"))
                ->orderByDesc('dms.id_mutasi_siswa');

            if($roleByJk != 'all'){
                // $getMutasi->where('ds.jenis_kelamin', $roleByJk);
            }
            $getMutasi = $getMutasi->get();

            $getMutasiTemporary = DB::table('d_mutasi_siswa_temporary as dmst')
                ->select('dmst.*', 'dmst.nama_siswa as nama', DB::raw("'' as nis"), DB::raw("'' as status"), DB::raw("'1' as temporary"))
                ->whereNull('dmst.deleted_at')
                ->orderByDesc('dmst.id_mutasi_siswa_temporary');

            if($roleByJk != 'all'){
                // $getMutasiTemporary->where('dmst.jenis_kelamin', $roleByJk);
            }
            $getMutasiTemporary = $getMutasiTemporary->get();

            $dataMutasi = $getMutasiTemporary->merge($getMutasi);

            return Datatables::of($dataMutasi)
                ->addIndexColumn()
                ->editColumn('tanggal_mutasi', function ($data){
                    if(!$data->tanggal_mutasi){
                        return '-';
                    } else {
                        return Carbon::parse($data->tanggal_mutasi)->translatedFormat('d F Y');
                    }
                })
                ->addColumn('action', function($row){
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $template = ['content' => 'content.siswa.mutasi', 'title' => 'Data Mutasi & Surat'];
        return view('layouts.v_template', $template);
    }

    public function surat(Request $request)
    {
        $roleByJk = 'all';
        if(!in_array(session('group_sequence'), [1])){
            $roleByJk = session('gender');
        } 

        if ($request->ajax()) {
            $getSurat = DB::table('d_surat_siswa as dss')
                ->leftJoin('d_siswa as ds', 'ds.id_siswa', '=', 'dss.id_siswa')
                ->select('dss.*', 'ds.nama', 'ds.nis', 'ds.jenis_kelamin', 'ds.status')
                ->orderByDesc('dss.id_surat_siswa');

            if($roleByJk != 'all'){
                // $getSurat->where('ds.jenis_kelamin', $roleByJk);
            }
            $getSurat = $getSurat->get();

            return Datatables::of($getSurat)
                ->addIndexColumn()
                ->editColumn('tanggal', function ($data){
                    if(!$data->tanggal){
                        return '-';
                    } else {
                        return Carbon::parse($data->tanggal)->translatedFormat('d F Y');
                    }
                })
                ->addColumn('action', function($row){
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $idMutasi = @$request->id_mutasi ?? null;
            $idSiswa = @$request->id_siswa ?? null;
            $temporary = @$request->temporary ?? null;
            $getMutasi = Siswa::getMutasi($idMutasi, $idSiswa, $temporary);

            DB::commit();
            return $this->sendSuccess('Berhasil', $getMutasi);
        } catch (ValidationException $e){
            DB::rollback();
            return $this->sendError($e->getCode(), $e->validator->errors());
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getCode(), $e->getMessage());
        }
    }

    public function editSurat(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $idSurat = @$request->id_surat ?? null;
            $idSiswa = @$request->id_siswa ?? null;
            $getSurat = Siswa::getSurat($idSurat, $idSiswa);

            DB::commit();
            return $this->sendSuccess('Berhasil', $getSurat);
        } catch (ValidationException $e){
            DB::rollback();
            return $this->sendError($e->getCode(), $e->validator->errors());
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getCode(), $e->getMessage());
        }
    }

    public function cetak(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $idMutasi = $request->id_mutasi ?? null;
            $idSiswa = $request->id_siswa ?? null;
            $temporary = $request->temporary ?? null;
            $dataMutasi = [];

            if($temporary == '0'){
                $getMutasi = DB::table('d_mutasi_siswa as dms')
                    ->leftJoin('d_siswa as ds', 'ds.id_siswa', '=', 'dms.id_siswa')
                    ->leftJoin('d_orangtua as do', 'do.id_siswa', '=', 'ds.id_siswa')
                    ->leftJoin('m_province as mp', 'mp.id_prov', '=', 'ds.propinsi')
                    ->leftJoin('m_district as md', 'md.id_kab', '=', 'ds.kota')
                    ->leftJoin('m_subdistrict as ms', 'ms.id_kec', '=', 'ds.kecamatan')
                    ->leftJoin('m_kelas as mk', 'mk.id_kelas', '=', 'ds.kelas')
                    ->select('ds.*', 'dms.*', 'mp.nama as nama_propinsi', 'md.nama as nama_kota', 'ms.nama as nama_kecamatan', 'do.nama_ayah', 'do.nama_ibu', 'mk.nama as kelas_siswa')
                    ->where('dms.id_siswa', $idSiswa)
                    ->where('dms.id_mutasi_siswa', $idMutasi)
                    ->get();
            } else {
                $getMutasi = DB::table('d_mutasi_siswa_temporary as dmst')
                    ->select('dmst.*')
                    ->where('id_mutasi_siswa_temporary', $idMutasi)
                    ->get();
            }

            if($getMutasi->count() > 0){
                $dataMutasi = $getMutasi->toArray()[0];
                $dataMutasi->tanggal_lahir = Carbon::parse($dataMutasi->tanggal_lahir)->translatedFormat('d F Y');
                $dataMutasi->tanggal_sekarang = Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y');
                $dataMutasi->tanggal_surat = Carbon::parse($dataMutasi->created_at)->translatedFormat('d F Y');
                $dataMutasi->tanggal_mutasi = Carbon::parse($dataMutasi->tanggal_mutasi)->translatedFormat('d F Y');
            }

            if($dataMutasi->jenis_mutasi == 'masuk'){
                if($temporary == '0'){
                    $htmlView = view('content.siswa.cetak_mutasi_masuk', compact('dataMutasi'))->render();
                    $fileName = 'Surat Mutasi Masuk '.$dataMutasi->nama.' ('.$dataMutasi->nis.') .pdf';
                } else {
                    $htmlView = view('content.siswa.cetak_mutasi_masuk_temporary', compact('dataMutasi'))->render();
                    $fileName = 'Surat Mutasi Masuk '.$dataMutasi->nama_siswa.'.pdf';
                }
            } else {
                $htmlView = view('content.siswa.cetak_mutasi_keluar', compact('dataMutasi'))->render();
                $fileName = 'Surat Mutasi Keluar '.$dataMutasi->nama.' ('.$dataMutasi->nis.') .pdf';
            }
            
            $pdf = PDF::loadHTML($htmlView)->setPaper('a4', 'portrait'); 
            return $pdf->stream($fileName);

            DB::commit();
        } catch (ValidationException $e){
            DB::rollback();
            return response(['status' => false, 'message' => $e->validator->errors(), 'data' => null]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['status' => false, 'message' => $e->getMessage(), 'data' => null]);
        }
    }

    public function cetakSk(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $idSiswa = $request->id_siswa ?? null;
            $idSurat = $request->id_surat ?? null;
            $today = date('Y-m-d');
            $tahunAjaranAktif = Siswa::getTahunAjaranAktif($today, $today);

            $getSiswa = DB::table('d_surat_siswa as dss')
                ->leftJoin('d_siswa as ds', 'ds.id_siswa', '=', 'dss.id_siswa')
                ->leftJoin('d_orangtua as do', 'do.id_siswa', '=', 'ds.id_siswa')
                ->leftJoin('m_kelas as mk', 'mk.id_kelas', '=', 'ds.kelas')
                ->leftJoin('m_province as mp', 'mp.id_prov', '=', 'ds.propinsi')
                ->leftJoin('m_district as md', 'md.id_kab', '=', 'ds.kota')
                ->leftJoin('m_subdistrict as ms', 'ms.id_kec', '=', 'ds.kecamatan')
                ->select('ds.*', 'dss.*', 'mp.nama as nama_propinsi', 'md.nama as nama_kota', 'ms.nama as nama_kecamatan', 'mk.nama as nama_kelas', 'do.nama_ayah', 'do.nama_ibu')
                ->where('dss.id_siswa', $idSiswa)
                ->where('dss.id_surat_siswa', $idSurat)
                ->get();

            if($getSiswa->count() > 0){
                $dataSiswa = $getSiswa->toArray()[0];
                $dataSiswa->tanggal_lahir = Carbon::parse($dataSiswa->tanggal_lahir)->translatedFormat('d F Y');
                $dataSiswa->tanggal_sekarang = Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y');
                $dataSiswa->tanggal_surat = Carbon::parse($dataSiswa->tanggal)->translatedFormat('d F Y');
                $dataSiswa->tahun_ajaran = @$tahunAjaranAktif->nama;
            }

            if(@$dataSiswa->jenis_surat == 'sk_aktif'){
                $htmlView = view('content.siswa.cetak_siswa_aktif', compact('dataSiswa'))->render();
            } else {
                $htmlView = view('content.siswa.cetak_siswa_baik', compact('dataSiswa'))->render();
            }
            $fileName = 'Surat SK Aktif '.@$dataSiswa->nama.' ('.@$dataSiswa->nis.').pdf';
            
            $pdf = PDF::loadHTML($htmlView)->setPaper('a4', 'portrait'); 
            return $pdf->stream($fileName);

            DB::commit();
        } catch (ValidationException $e){
            DB::rollback();
            return response(['status' => false, 'message' => $e->validator->errors(), 'data' => null]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['status' => false, 'message' => $e->getMessage(), 'data' => null]);
        }
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $jenisMutasi = $request->jenis_mutasi ?? null;
            $parameterValidation = [
                'nomor_mutasi' => 'required',
                'jenis_mutasi' => 'required',
                'tanggal_mutasi' => 'required',
                'nama_sekolah' => 'required',
            ];

            if($jenisMutasi=='masuk'){
                $parameterValidation['nama_siswa'] = 'required';
                $parameterValidation['tempat_lahir'] = 'required';
                $parameterValidation['tanggal_lahir'] = 'required';
                $parameterValidation['nisn'] = 'required';
                $parameterValidation['jenis_kelamin'] = 'required';
                $parameterValidation['orang_tua'] = 'required';
                $parameterValidation['agama'] = 'required';
                $parameterValidation['alamat_siswa'] = 'required';
                $parameterValidation['kelas_siswa'] = 'required';
            } else {
                $parameterValidation['id_siswa'] = 'required';
            }

            $validatorMessage['nomor_mutasi.required'] = 'Nomor Surat wajib diisi';
            $validatorMessage['id_siswa.required'] = 'Siswa Wajib diisi';
            $validatorMessage['nama_siswa.required'] = 'Wajib diisi';
            $validatorMessage['tempat_lahir.required'] = 'Wajib diisi';
            $validatorMessage['nisn.required'] = 'Wajib diisi';
            $validatorMessage['jenis_kelamin.required'] = 'Wajib diisi';
            $validatorMessage['orang_tua.required'] = 'Wajib diisi';
            $validatorMessage['agama.required'] = 'Wajib diisi';
            $validatorMessage['alamat_siswa.required'] = 'Wajib diisi';
            $validatorMessage['kelas_siswa.required'] = 'Wajib diisi';
            $validatorMessage['tanggal_mutasi.required'] = 'Wajib diisi';

            $validator = Validator::make($request->all(), $parameterValidation, $validatorMessage);
            if($validator->fails()){
                throw new ValidationException($validator);
            }

            $idMutasi = $request->id_mutasi_siswa ?? null;
            $idMutasiTemporary = $request->id_mutasi_siswa_temporary ?? null;

            if($jenisMutasi=='keluar'){
                $dataMutasi = [
                    'id_siswa'          => $request->id_siswa ?? null,
                    'nomor_mutasi'      => $request->nomor_mutasi ?? null,
                    'jenis_mutasi'      => $jenisMutasi,
                    'tanggal_mutasi'    => $request->tanggal_mutasi ?? null,
                    'nsm'               => $request->nsm ?? null,
                    'npsn'              => $request->npsn ?? null,
                    'nama_sekolah'      => $request->nama_sekolah ?? null,
                    'alasan'            => $request->alasan ?? null,
                    'catatan_mutasi'    => $request->catatan_mutasi ?? null,
                    'keterangan'        => $request->keterangan ?? null,
                ];

                if(!$idMutasi){
                    $dataMutasi['created_at'] = date('Y-m-d H:i:s');
                    $dataMutasi['created_by'] = session('id_user');
                    $insertMutasi = DB::table('d_mutasi_siswa')->insertGetId($dataMutasi);
                } else {
                    $dataMutasi['updated_at'] = date('Y-m-d H:i:s');
                    $dataMutasi['updated_by'] = session('id_user');
                    $update = DB::table('d_mutasi_siswa')->where('id_mutasi_siswa', $idMutasi)->update($dataMutasi);
                    $insertMutasi = $idMutasi;
                }
            } 
            else {
                $dataMutasiTemporary = [
                    'nama_siswa'        => strtoupper($request->nama_siswa) ?? null,
                    'tempat_lahir'      => strtoupper($request->tempat_lahir) ?? null,
                    'tanggal_lahir'     => $request->tanggal_lahir ?? null,
                    'nisn'              => strtoupper($request->nisn) ?? null,
                    'jenis_kelamin'     => strtoupper($request->jenis_kelamin) ?? null,
                    'orang_tua'         => strtoupper($request->orang_tua) ?? null,
                    'agama'             => $request->agama ?? null,
                    'alamat_siswa'      => strtoupper($request->alamat_siswa) ?? null,
                    'kelas_siswa'       => strtoupper($request->kelas_siswa) ?? null,
                    'nomor_mutasi'      => $request->nomor_mutasi ?? null,
                    'jenis_mutasi'      => $jenisMutasi,
                    'tanggal_mutasi'    => $request->tanggal_mutasi ?? null,
                    'nsm'               => $request->nsm ?? null,
                    'npsn'              => $request->npsn ?? null,
                    'nama_sekolah'      => strtoupper($request->nama_sekolah) ?? null,
                    'alasan'            => $request->alasan ?? null,
                    'catatan_mutasi'    => $request->catatan_mutasi ?? null,
                    'keterangan'        => $request->keterangan ?? null,
                ];

                if(!$idMutasiTemporary){
                    $dataMutasiTemporary['created_at'] = date('Y-m-d H:i:s');
                    $dataMutasiTemporary['created_by'] = session('id_user');
                    $insertMutasi = DB::table('d_mutasi_siswa_temporary')->insertGetId($dataMutasiTemporary);
                } else {
                    $dataMutasiTemporary['updated_at'] = date('Y-m-d H:i:s');
                    $dataMutasiTemporary['updated_by'] = session('id_user');
                    $update = DB::table('d_mutasi_siswa_temporary')->where('id_mutasi_siswa_temporary', $idMutasiTemporary)->update($dataMutasiTemporary);
                    $insertMutasi = $idMutasiTemporary;
                }
            }

            DB::commit();
            return $this->sendSuccess('Berhasil disimpan', $insertMutasi);
        } catch (ValidationException $e){
            DB::rollback();
            return $this->sendError($e->getCode(), $e->validator->errors());
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getCode(), $e->getMessage());
        }
    }

    public function storeSurat(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $parameterValidation = [
                'nomor_surat' => 'required',
                'id_siswa' => 'required',
                'jenis_surat' => 'required',
            ];
            $validatorMessage['nomor_surat.required'] = 'Nomor Surat wajib diisi';
            $validatorMessage['id_siswa.required'] = 'Siswa Wajib diisi';
            $validator = Validator::make($request->all(), $parameterValidation, $validatorMessage);
            if($validator->fails()){
                throw new ValidationException($validator);
            }

            $idSurat = $request->id_surat_siswa ?? null;
            $dataSurat = [
                'id_siswa'          => $request->id_siswa ?? null,
                'nomor_surat'       => $request->nomor_surat ?? null,
                'jenis_surat'       => $request->jenis_surat ?? null,
                'tanggal'           => date('Y-m-d'),
                'nsm'               => $request->nsm ?? null,
                'npsn'              => $request->npsn ?? null,
                'alasan'            => $request->alasan ?? null,
                'catatan'           => $request->catatan ?? null,
                'keterangan'        => $request->keterangan ?? null,
            ];
            if(!$idSurat){
                $dataSurat['created_at'] = date('Y-m-d H:i:s');
                $dataSurat['created_by'] = session('id_user');
                $insertSurat = DB::table('d_surat_siswa')->insertGetId($dataSurat);
            } else {
                $dataSurat['updated_at'] = date('Y-m-d H:i:s');
                $dataSurat['updated_by'] = session('id_user');
                $update = DB::table('d_surat_siswa')->where('id_surat_siswa', $idSurat)->update($dataSurat);
                $insertSurat = $idSurat;
            }

            DB::commit();
            return $this->sendSuccess('Berhasil disimpan', $insertSurat);
        } catch (ValidationException $e){
            DB::rollback();
            return $this->sendError($e->getCode(), $e->validator->errors());
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getCode(), $e->getMessage());
        }
    }

}
