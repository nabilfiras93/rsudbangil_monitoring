<?php

namespace App\Http\Controllers\Antrian\Table;

use App\Http\Controllers\Controller;
use App\Models\Antrian\Patient;
use App\Models\MWLWL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = DB::table('antrian_patientwl')
                ->join('antrian_mwlwl', 'antrian_patientwl.PATIENT_ID', '=', 'antrian_mwlwl.PATIENT_ID')
                ->leftJoin('report_ris_2024-11-09', 'report_ris_2024-11-09.ACCESSION_NO', '=', 'antrian_mwlwl.ACCESSION_NO')
                ->leftJoin('antrian_study_ris as sris', function ($join) {
                    $join->on('report_ris_2024-11-09.ACCESSION_NO', '=', 'sris.ACCESSION_NO');
                    $join->where('sris.PATIENT_LOCATION', 'Radiologi');
                })
                ->select('antrian_patientwl.PATIENT_ID','antrian_patientwl.PATIENT_SEX','antrian_mwlwl.ACCESSION_NO','antrian_patientwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                // ->select('antrian_mwlwl.ACCESSION_NO', 'report_ris.ACCESSION_NO', 'antrian_study_ris.ACCESSION_NO')
                ->where('antrian_mwlwl.PATIENT_LOCATION', 'Radiologi')
                ->groupBy('antrian_patientwl.PATIENT_ID','antrian_patientwl.PATIENT_SEX','antrian_mwlwl.ACCESSION_NO','antrian_patientwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                ->get();
        $data = DB::table('antrian_patientwl')->select('PATIENT_ID','PATIENT_NAME')->get();
        // dd($patients);
        return view("antrian.tables.pasien.index", compact('patients','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function searchPatient(Request $request)
    {
        $keyword = $request->input('query');
        // Mencari pasien berdasarkan nama di tabel antrian_patientwl
        $patients = DB::table('antrian_patientwl')
            ->select('PATIENT_NAME','PATIENT_ID') // Mengambil hanya nama pasien
            ->where('PATIENT_NAME', 'like', "%$keyword%")
            // ->where('PATIENT_ID', 'like', "%$keyword%")
            ->get();

        return response()->json($patients);
    }
}
