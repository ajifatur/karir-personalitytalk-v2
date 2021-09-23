<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Office;

use App\Models\Hasil;
use App\Models\HRD;
use App\Models\Kantor;
use App\Models\Karyawan;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\Posisi;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the company user
        $company_user = Auth::user()->role_id != role('admin') ? Company::where('user_id','=',Auth::user()->id)->first() : null;

        // Count the companies
        $companies = Auth::user()->role_id == role('admin') ? Company::count() : Company::where('user_id','=',Auth::user()->id)->count();
        
        // Count the offices
        $offices = Auth::user()->role_id == role('admin') ? Office::count() : Office::where('company_id','=',$company_user->id)->count();
        
        // Count the employees
        $employees = Auth::user()->role_id == role('admin') ? Employee::count() : Employee::where('company_id','=',$company_user->id)->count();
        
        // // Pelamar
        // $pelamar = Auth::user()->role == role_admin() ? Pelamar::join('users','pelamar.id_user','=','users.id_user')->count() : Pelamar::join('users','pelamar.id_user','=','users.id_user')->where('id_hrd','=',$hrd->id_hrd)->count();
        
        // // Posisi
        // $posisi = Auth::user()->role == role_admin() ? Posisi::count() : Posisi::where('id_hrd','=',$hrd->id_hrd)->count();
        
        // // Lowongan
        // $lowongan = Auth::user()->role == role_admin() ? Lowongan::count() : Lowongan::where('id_hrd','=',$hrd->id_hrd)->count();
        
        // // Hasil Tes Karyawan
        // $hasil_karyawan = Auth::user()->role == role_admin() ? Hasil::join('users','hasil.id_user','=','users.id_user')->where('role','=',role_karyawan())->count() : Hasil::join('users','hasil.id_user','=','users.id_user')->where('id_hrd','=',$hrd->id_hrd)->where('role','=',role_karyawan())->count();
        
        // // Hasil Tes Pelamar
        // $hasil_pelamar = Auth::user()->role == role_admin() ? Hasil::join('users','hasil.id_user','=','users.id_user')->where('role','=',role_pelamar())->count() : Hasil::join('users','hasil.id_user','=','users.id_user')->where('id_hrd','=',$hrd->id_hrd)->where('role','=',role_pelamar())->count();

        // // Hasil Tes Magang
        // $hasil_magang = Auth::user()->role == role_admin() ? Hasil::join('users','hasil.id_user','=','users.id_user')->where('role','=',role_magang())->count() : 0;
        
        // View
        return view('admin/dashboard/index', [
            'hrd' => $hrd,
            'perusahaan' => $perusahaan,
            'karyawan' => $karyawan,
            'pelamar' => $pelamar,
            'kantor' => $kantor,
            'posisi' => $posisi,
            'lowongan' => $lowongan,
            'hasil_karyawan' => $hasil_karyawan,
            'hasil_pelamar' => $hasil_pelamar,
            'hasil_magang' => $hasil_magang,
        ]);
    }
}
