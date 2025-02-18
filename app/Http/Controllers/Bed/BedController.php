<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Models\Bed;
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

    }

    public function list(Request $request)
    {
        ini_set('max_execution_time', -1);
        
        if ($request->expectsJson()) {
            $getBed = Bed::getBed();
            $allRuangan = $getBed->pluck('ruangan')->unique();
            $allKamar = [];
            foreach ($getBed as $k => $val) {
                $allKamar[$val->ruangan][$val->kamar][] = [
                    'kelas' => $val->kelas,
                    'jumlah_tt' => $val->jumlah_tt,
                ];
            }
            return $this->sendSuccess('Berhasil', $allKamar);
        }
        return view('bed.list');
    }

    public function edit(Request $request)
    {
        ini_set('max_execution_time', -1);
        DB::beginTransaction();
        try {
            $idUnit = @$request->id_unit ?? null;
            $kelas = @$request->kelas ?? null;
            // $getMutasi = Siswa::getMutasi($idMutasi, $idSiswa, $temporary);

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
}
