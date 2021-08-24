<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest Capabilities...
Route::group(['middleware' => ['guest']], function(){

	// Home
	Route::get('/', function () {
	   return redirect('/login');
	});

	// Login
	Route::get('/login', 'Auth\LoginController@showLoginForm');
	Route::post('/login', 'Auth\LoginController@login');

	// Applicant Register
	Route::get('/lowongan/{code}/daftar/step-1', 'ApplicantRegisterController@showRegistrationFormStep1');
	Route::post('/lowongan/{code}/daftar/step-1', 'ApplicantRegisterController@submitRegistrationFormStep1');
	Route::get('/lowongan/{code}/daftar/step-2', 'ApplicantRegisterController@showRegistrationFormStep2');
	Route::post('/lowongan/{code}/daftar/step-2', 'ApplicantRegisterController@submitRegistrationFormStep2');
	Route::get('/lowongan/{code}/daftar/step-3', 'ApplicantRegisterController@showRegistrationFormStep3');
	Route::post('/lowongan/{code}/daftar/step-3', 'ApplicantRegisterController@submitRegistrationFormStep3');
	Route::get('/lowongan/{code}/daftar/step-4', 'ApplicantRegisterController@showRegistrationFormStep4');
	Route::post('/lowongan/{code}/daftar/step-4', 'ApplicantRegisterController@submitRegistrationFormStep4');
	Route::get('/lowongan/{code}/daftar/step-5', 'ApplicantRegisterController@showRegistrationFormStep5');
	Route::post('/lowongan/{code}/daftar/step-5', 'ApplicantRegisterController@submitRegistrationFormStep5');
	// Route::get('/applicant/register/step-1', 'ApplicantRegisterController@showRegistrationFormStep1');
	// Route::post('/applicant/register/step-1', 'ApplicantRegisterController@submitRegistrationFormStep1');
	// Route::get('/applicant/register/step-2', 'ApplicantRegisterController@showRegistrationFormStep2');
	// Route::post('/applicant/register/step-2', 'ApplicantRegisterController@submitRegistrationFormStep2');
	// Route::get('/applicant/register/step-3', 'ApplicantRegisterController@showRegistrationFormStep3');
	// Route::post('/applicant/register/step-3', 'ApplicantRegisterController@submitRegistrationFormStep3');
	// Route::get('/applicant/register/step-4', 'ApplicantRegisterController@showRegistrationFormStep4');
	// Route::post('/applicant/register/step-4', 'ApplicantRegisterController@submitRegistrationFormStep4');
	// Route::get('/applicant/register/step-5', 'ApplicantRegisterController@showRegistrationFormStep5');
	// Route::post('/applicant/register/step-5', 'ApplicantRegisterController@submitRegistrationFormStep5');
	//

	// URL Form
	Route::get('/lowongan/{url}', 'LowonganController@visitForm');

	// Register as General Member
	Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
	Route::post('/register', 'Auth\RegisterController@submitRegistrationForm');
});
    
// Admin Capabilities
Route::group(['middleware' => ['admin']], function(){

	// Logout
	Route::post('/admin/logout', 'AdminLoginController@logout');

	// Dashboard
	Route::get('/admin', 'DashboardController@index');

	// Company
	Route::get('/admin/company', 'CompanyController@index')->name('admin.company.index');
	Route::get('/admin/company/create', 'CompanyController@create')->name('admin.company.create');
	Route::post('/admin/company/store', 'CompanyController@store')->name('admin.company.store');
	Route::get('/admin/company/detail/{id}', 'CompanyController@detail')->name('admin.company.detail');
	Route::get('/admin/company/edit/{id}', 'CompanyController@edit')->name('admin.company.edit');
	Route::post('/admin/company/update', 'CompanyController@update')->name('admin.company.update');
	Route::post('/admin/company/delete', 'CompanyController@delete')->name('admin.company.delete');

	// Office
	Route::get('/admin/office', 'OfficeController@index')->name('admin.office.index');
	Route::get('/admin/office/create', 'OfficeController@create')->name('admin.office.create');
	Route::post('/admin/office/store', 'OfficeController@store')->name('admin.office.store');
	Route::get('/admin/office/detail/{id}', 'OfficeController@detail')->name('admin.office.detail');
	Route::get('/admin/office/edit/{id}', 'OfficeController@edit')->name('admin.office.edit');
	Route::post('/admin/office/update', 'OfficeController@update')->name('admin.office.update');
	Route::post('/admin/office/delete', 'OfficeController@delete')->name('admin.office.delete');
	
	// Profil
	Route::get('/admin/profil', 'HRDController@profile');
	Route::get('/admin/profil/edit', 'HRDController@editProfil');
	Route::post('/admin/profil/update', 'HRDController@updateProfil');
	Route::get('/admin/profil/edit-password', 'HRDController@editPassword');
	Route::post('/admin/profil/update-password', 'HRDController@updatePassword');

	// Update Sistem
	Route::get('/admin/update-sistem', function(){
		// View
		return view('update-sistem/index');
	});

	// Kantor Menu
	Route::get('/admin/kantor', 'KantorController@index');
	Route::get('/admin/kantor/create', 'KantorController@create');
	Route::post('/admin/kantor/store', 'KantorController@store');
	Route::get('/admin/kantor/edit/{id}', 'KantorController@edit');
	Route::post('/admin/kantor/update', 'KantorController@update');
	Route::post('/admin/kantor/delete', 'KantorController@delete');

	// Jabatan Menu
	Route::get('/admin/posisi', 'PosisiController@index');
	Route::get('/admin/posisi/create', 'PosisiController@create');
	Route::post('/admin/posisi/store', 'PosisiController@store');
	Route::get('/admin/posisi/edit/{id}', 'PosisiController@edit');
	Route::post('/admin/posisi/update', 'PosisiController@update');
	Route::post('/admin/posisi/delete', 'PosisiController@delete');

	// Lowongan Menu
	Route::get('/admin/lowongan', 'LowonganController@index');
	Route::get('/admin/lowongan/create', 'LowonganController@create');
	Route::post('/admin/lowongan/store', 'LowonganController@store');
	Route::get('/admin/lowongan/pelamar/{id}', 'LowonganController@applicant');
	Route::post('/admin/lowongan/update-status', 'LowonganController@updateStatus');
	Route::get('/admin/lowongan/edit/{id}', 'LowonganController@edit');
	Route::post('/admin/lowongan/update', 'LowonganController@update');
	Route::post('/admin/lowongan/delete', 'LowonganController@delete');

	// Seleksi Menu
	Route::get('/admin/seleksi', 'SeleksiController@index');
	Route::post('/admin/seleksi/store', 'SeleksiController@store');
	Route::post('/admin/seleksi/data', 'SeleksiController@data');
	Route::post('/admin/seleksi/update', 'SeleksiController@update');
	Route::post('/admin/seleksi/convert', 'SeleksiController@convert');
	Route::post('/admin/seleksi/delete', 'SeleksiController@delete');

	// Agama Menu
	Route::get('/admin/agama', 'AgamaController@index');
	Route::get('/admin/agama/create', 'AgamaController@create');
	Route::post('/admin/agama/store', 'AgamaController@store');
	Route::get('/admin/agama/edit/{id}', 'AgamaController@edit');
	Route::post('/admin/agama/update', 'AgamaController@update');
	Route::post('/admin/agama/delete', 'AgamaController@delete');

	// Tes Menu
	Route::get('/admin/tes', 'TesController@index');
	Route::get('/admin/tes/create', 'TesController@create');
	Route::post('/admin/tes/store', 'TesController@store');
	Route::get('/admin/tes/edit/{id}', 'TesController@edit');
	Route::post('/admin/tes/update', 'TesController@update');
	Route::post('/admin/tes/delete', 'TesController@delete');
	Route::post('/admin/tes/generate-path', 'TesController@generatePath');

	// Hasil Menu
	// Route::get('/admin/hasil', 'HasilController@index');
	Route::get('/admin/hasil/karyawan', 'HasilController@employeer');
	Route::get('/admin/hasil/pelamar', 'HasilController@applicant');
	Route::get('/admin/hasil/magang', 'HasilController@internship');
	Route::get('/admin/hasil/detail/{id}', 'HasilController@detail');
	Route::post('/admin/hasil/print', 'HasilController@pdf');
	Route::post('/admin/hasil/delete', 'HasilController@delete');
	Route::get('/admin/hasil/json/karyawan', 'HasilController@json_employeer');
	Route::get('/admin/hasil/json/pelamar', 'HasilController@json_applicant');
	Route::get('/admin/hasil/json/magang', 'HasilController@json_internship');

	// Admin Menu
	Route::get('/admin/list', 'UserController@admin');
	Route::get('/admin/create', 'UserController@createAdmin');
	Route::post('/admin/store', 'UserController@storeAdmin');
	Route::get('/admin/edit/{id}', 'UserController@editAdmin');
	Route::post('/admin/update', 'UserController@updateAdmin');
	Route::post('/admin/delete', 'UserController@delete');

	// HRD Menu
	Route::get('/admin/hrd', 'HRDController@index');
	Route::get('/admin/hrd/create', 'HRDController@create');
	Route::post('/admin/hrd/store', 'HRDController@store');
	Route::get('/admin/hrd/edit/{id}', 'HRDController@edit');
	Route::post('/admin/hrd/update', 'HRDController@update');
	Route::post('/admin/hrd/delete', 'HRDController@delete');

	// Karyawan Menu
	Route::get('/admin/karyawan', 'KaryawanController@index');
	Route::get('/admin/karyawan/create', 'KaryawanController@create');
	Route::post('/admin/karyawan/store', 'KaryawanController@store');
	Route::get('/admin/karyawan/detail/{id}', 'KaryawanController@detail');
	Route::get('/admin/karyawan/edit/{id}', 'KaryawanController@edit');
	Route::post('/admin/karyawan/update', 'KaryawanController@update');
	Route::post('/admin/karyawan/delete', 'KaryawanController@delete');
	Route::get('/admin/karyawan/export', 'KaryawanController@export');
	Route::post('/admin/karyawan/import', 'KaryawanController@import');
	Route::get('/admin/karyawan/json', 'KaryawanController@json');

	// Pelamar Menu
	Route::get('/admin/pelamar', 'PelamarController@index');
	Route::get('/admin/pelamar/detail/{id}', 'PelamarController@detail');
	Route::get('/admin/pelamar/edit/{id}', 'PelamarController@edit');
	Route::post('/admin/pelamar/update', 'PelamarController@update');
	Route::post('/admin/pelamar/delete', 'PelamarController@delete');
	Route::get('/admin/pelamar/export', 'PelamarController@export');
	Route::get('/admin/pelamar/json', 'PelamarController@json');

	// // General Member Menu
	// Route::get('/admin/umum', 'UserController@general');
	// Route::post('/admin/umum/delete', 'UserController@delete');

	/*
	// Role Menu
	Route::get('/admin/role', 'RoleController@index');
	Route::get('/admin/role/create', 'RoleController@create');
	Route::post('/admin/role/store', 'RoleController@store');
	Route::get('/admin/role/edit/{id}', 'RoleController@edit');
	Route::post('/admin/role/update', 'RoleController@update');

	// Tipe Tes Menu
	Route::get('/admin/tes/tipe/{id}', 'PaketSoalController@index');
	Route::get('/admin/tes/tipe/{id}/paket/create', 'PaketSoalController@create');
	Route::post('/admin/tes/tipe/{id}/paket/store', 'PaketSoalController@store');
	Route::get('/admin/tes/tipe/{id}/paket/edit/{id_paket}', 'PaketSoalController@edit');
	Route::post('/admin/tes/tipe/{id}/paket/update', 'PaketSoalController@update');
	Route::post('/admin/tes/tipe/{id}/paket/update-status', 'PaketSoalController@updateStatus');
	Route::post('/admin/tes/tipe/{id}/paket/delete', 'PaketSoalController@delete');

	// Tutorial Tes Menu
	Route::get('/admin/tes/tipe/{id}/paket/tutorial/{id_paket}', 'TutorialController@index');
	Route::post('/admin/tes/tipe/{id}/paket/tutorial/save', 'TutorialController@save');
	Route::post('/admin/tes/tipe/{id}/paket/tutorial/delete', 'TutorialController@delete');

	// Keterangan Tes Menu
	Route::get('/admin/tes/tipe/{id}/paket/keterangan/{id_paket}', 'KeteranganController@index');
	Route::post('/admin/tes/tipe/{id}/paket/keterangan/save', 'KeteranganController@save');
	Route::post('/admin/tes/tipe/{id}/paket/keterangan/delete', 'KeteranganController@delete');

	// Soal Tes Menu
	Route::get('/admin/tes/tipe/{id}/paket/soal/{id_paket}', 'SoalController@index');
	Route::get('/admin/tes/tipe/{id}/soal/create/{id_paket}', 'SoalController@create');
	Route::post('/admin/tes/tipe/{id}/soal/store', 'SoalController@store');
	Route::get('/admin/tes/tipe/{id}/soal/edit/{id_soal}', 'SoalController@edit');
	Route::post('/admin/tes/tipe/{id}/soal/update', 'SoalController@update');
	Route::post('/admin/tes/tipe/{id}/soal/delete', 'SoalController@delete');
	Route::get('/admin/tes/tipe/{id}/soal/export/{id_paket}', 'SoalController@exportExcel');
	Route::get('/admin/tes/tipe/{id}/soal/import/{id_paket}', 'SoalController@importForm');
	Route::post('/admin/tes/tipe/{id}/soal/import/post', 'SoalController@importExcel');
	*/
});