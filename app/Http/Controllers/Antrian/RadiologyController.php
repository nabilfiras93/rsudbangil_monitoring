<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use App\Models\Antrian\Doctor;
use App\Models\Mwlwl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadiologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('antrian_patientwl')
                ->join('antrian_mwlwl', 'antrian_patientwl.PATIENT_ID', '=', 'antrian_mwlwl.PATIENT_ID')
                ->leftJoin('report_ris_2024-11-09', 'report_ris_2024-11-09.ACCESSION_NO', '=', 'antrian_mwlwl.ACCESSION_NO')
                ->leftJoin('antrian_study_ris as sris', function ($join) {
                    $join->on('report_ris_2024-11-09.ACCESSION_NO', '=', 'sris.ACCESSION_NO');
                    $join->where('sris.PATIENT_LOCATION', 'Radiologi');
                })
                ->select('antrian_patientwl.PATIENT_ID','antrian_mwlwl.ACCESSION_NO','antrian_patientwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                // ->select('antrian_mwlwl.ACCESSION_NO', 'report_ris.ACCESSION_NO', 'antrian_study_ris.ACCESSION_NO')
                ->where('antrian_mwlwl.PATIENT_LOCATION', 'Radiologi')
                ->groupBy('antrian_patientwl.PATIENT_ID','antrian_mwlwl.ACCESSION_NO','antrian_patientwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                ->get();
        // $data = Mwlwl::all();
        $jumlah = Mwlwl::where('PATIENT_LOCATION', 'Radiologi')->get();
        $doctors = Doctor::select('nama','gelar_belakang')->where('unit_ruang', 'radiologi')->limit(10)->get();
        // dd($doctors);
        // $data = Mwlwl::select('ACCESSION_NO','PATIENT_NAME')->limit(10)->get();
        return view("antrian.pages.radiology", compact('data','doctors','jumlah'));
    }

    public function dashboard()
    {
        $data = DB::table('antrian_patientwl')
                ->join('antrian_mwlwl', 'antrian_patientwl.PATIENT_ID', '=', 'antrian_mwlwl.PATIENT_ID')
                ->leftJoin('report_ris_2024-11-09', 'report_ris_2024-11-09.ACCESSION_NO', '=', 'antrian_mwlwl.ACCESSION_NO')
                ->leftJoin('antrian_study_ris as sris', function ($join) {
                    $join->on('report_ris_2024-11-09.ACCESSION_NO', '=', 'sris.ACCESSION_NO');
                    $join->where('sris.PATIENT_LOCATION', 'Radiologi');
                })
                ->select('antrian_patientwl.PATIENT_ID','antrian_mwlwl.ACCESSION_NO','antrian_patientwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                // ->select('antrian_mwlwl.ACCESSION_NO', 'report_ris.ACCESSION_NO', 'antrian_study_ris.ACCESSION_NO')
                ->where('antrian_mwlwl.PATIENT_LOCATION', 'Radiologi')
                ->groupBy('antrian_patientwl.PATIENT_ID','antrian_mwlwl.ACCESSION_NO','antrian_patientwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                ->get();
                // dd($data);
        $doctors = Doctor::select('nama','gelar_belakang')->where('unit_ruang', 'radiologi')->limit(10)->get();
        // $data = Mwlwl::select('ACCESSION_NO', 'PATIENT_NAME')->where('PATIENT_LOCATION', 'Radiologi')->get();
        return view('antrian.dashboard', compact('data','doctors'));
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
}
