<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Bed extends Model
{
    use HasFactory;

    public static function getKamar($idUnit=null, $kelas=null) {
        $getKamar = DB::connection('billing')->table('b_ms_kamar as bmk')
            ->leftJoin('b_ms_kamar_tarip as bmkt', 'bmk.id', '=', 'bmkt.kamar_id')
            ->leftJoin('b_ms_kelas as bmk2', 'bmk2.id', '=', 'bmkt.kelas_id')
            ->leftJoin('b_ms_unit as bmu', 'bmu.id', '=', 'bmk.unit_id')
            ->select('bmu.nama','bmk.jumlah_tt', 'bmk2.nama as kelas');
        
        if($idUnit){
            if(strpos(strtolower($idUnit), ',') !== false){
                $idUnit = explode(',', $idUnit);
            } else {
                $idUnit = [$idUnit];
            }
            $idUnit = is_array($idUnit) ? $idUnit : [$idUnit];
            $getKamar->where('bmk.unit_id', $idUnit);
        }
        if($kelas){
            if(strpos(strtolower($kelas), ',') !== false){
                $kelas = explode(',', $kelas);
            } else {
                $kelas = [$kelas];
            }
            $kelas = is_array($kelas) ? $kelas : [$kelas];
            $getKamar->where('bmkt.kelas_id', $kelas);
        }
        $result = $getKamar->get();
        
        return $result;
    }

    public static function getBed($idUnit=null, $kelas=null) {
        $getBed = DB::connection('billing')->table('b_ms_kamar as bmk')
            ->leftJoin('b_ms_kamar_tarip as bmkt', 'bmk.id', '=', 'bmkt.kamar_id')
            ->leftJoin('b_ms_kelas as bmk2', 'bmk2.id', '=', 'bmkt.kelas_id')
            ->leftJoin('b_ms_unit as bmu', 'bmu.id', '=', 'bmk.unit_id')
            ->select('bmu.nama as ruangan', 'bmk.nama as kamar',  'bmk.jumlah_tt', 'bmk2.nama as kelas')
            ->where('bmk.aktif', 1);
        
        if($idUnit){
            if(strpos(strtolower($idUnit), ',') !== false){
                $idUnit = explode(',', $idUnit);
            } else {
                $idUnit = [$idUnit];
            }
            $idUnit = is_array($idUnit) ? $idUnit : [$idUnit];
            $getBed->where('bmk.unit_id', $idUnit);
        }
        if($kelas){
            if(strpos(strtolower($kelas), ',') !== false){
                $kelas = explode(',', $kelas);
            } else {
                $kelas = [$kelas];
            }
            $kelas = is_array($kelas) ? $kelas : [$kelas];
            $getBed->where('bmkt.kelas_id', $kelas);
        }
        $getBed->orderBy('bmu.nama')->orderBy('bmk.nama')->orderBy('bmk2.nama');
        $result = $getBed->get();
        
        return $result;
    }
}
