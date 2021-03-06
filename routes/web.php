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

	// Register for Applicant
	Route::get('/vacancy/register/{code}', 'VacancyController@registrationForm');

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

	// Position
	Route::get('/admin/position', 'PositionController@index')->name('admin.position.index');
	Route::get('/admin/position/create', 'PositionController@create')->name('admin.position.create');
	Route::post('/admin/position/store', 'PositionController@store')->name('admin.position.store');
	Route::get('/admin/position/detail/{id}', 'PositionController@detail')->name('admin.position.detail');
	Route::get('/admin/position/edit/{id}', 'PositionController@edit')->name('admin.position.edit');
	Route::post('/admin/position/update', 'PositionController@update')->name('admin.position.update');
	Route::post('/admin/position/delete', 'PositionController@delete')->name('admin.position.delete');

	// Vacancy
	Route::get('/admin/vacancy', 'VacancyController@index')->name('admin.vacancy.index');
	Route::get('/admin/vacancy/create', 'VacancyController@create')->name('admin.vacancy.create');
	Route::post('/admin/vacancy/store', 'VacancyController@store')->name('admin.vacancy.store');
	Route::get('/admin/vacancy/detail/{id}', 'VacancyController@detail')->name('admin.vacancy.detail');
	Route::get('/admin/vacancy/edit/{id}', 'VacancyController@edit')->name('admin.vacancy.edit');
	Route::post('/admin/vacancy/update', 'VacancyController@update')->name('admin.vacancy.update');
	Route::post('/admin/vacancy/delete', 'VacancyController@delete')->name('admin.vacancy.delete');

	// Employee
	Route::get('/admin/employee', 'EmployeeController@index')->name('admin.employee.index');
	Route::get('/admin/employee/create', 'EmployeeController@create')->name('admin.employee.create');
	Route::post('/admin/employee/store', 'EmployeeController@store')->name('admin.employee.store');
	Route::get('/admin/employee/detail/{id}', 'EmployeeController@detail')->name('admin.employee.detail');
	Route::get('/admin/employee/edit/{id}', 'EmployeeController@edit')->name('admin.employee.edit');
	Route::post('/admin/employee/update', 'EmployeeController@update')->name('admin.employee.update');
	Route::post('/admin/employee/delete', 'EmployeeController@delete')->name('admin.employee.delete');

	// Applicant
	Route::get('/admin/applicant', 'ApplicantController@index')->name('admin.applicant.index');
	Route::get('/admin/applicant/create', 'ApplicantController@create')->name('admin.applicant.create');
	Route::post('/admin/applicant/store', 'ApplicantController@store')->name('admin.applicant.store');
	Route::get('/admin/applicant/detail/{id}', 'ApplicantController@detail')->name('admin.applicant.detail');
	Route::get('/admin/applicant/edit/{id}', 'ApplicantController@edit')->name('admin.applicant.edit');
	Route::post('/admin/applicant/update', 'ApplicantController@update')->name('admin.applicant.update');
	Route::post('/admin/applicant/delete', 'ApplicantController@delete')->name('admin.applicant.delete');

	// Role
	Route::get('/admin/role', 'RoleController@index')->name('admin.role.index');
	Route::get('/admin/role/create', 'RoleController@create')->name('admin.role.create');
	Route::post('/admin/role/store', 'RoleController@store')->name('admin.role.store');
	Route::get('/admin/role/detail/{id}', 'RoleController@detail')->name('admin.role.detail');
	Route::get('/admin/role/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
	Route::post('/admin/role/update', 'RoleController@update')->name('admin.role.update');
	Route::post('/admin/role/delete', 'RoleController@delete')->name('admin.role.delete');

	// Test
	Route::get('/admin/test', 'TestController@index')->name('admin.test.index');
	Route::get('/admin/test/create', 'TestController@create')->name('admin.test.create');
	Route::post('/admin/test/store', 'TestController@store')->name('admin.test.store');
	Route::get('/admin/test/detail/{id}', 'TestController@detail')->name('admin.test.detail');
	Route::get('/admin/test/edit/{id}', 'TestController@edit')->name('admin.test.edit');
	Route::post('/admin/test/update', 'TestController@update')->name('admin.test.update');
	Route::post('/admin/test/delete', 'TestController@delete')->name('admin.test.delete');

	// Religion
	Route::get('/admin/religion', 'ReligionController@index')->name('admin.religion.index');
	Route::get('/admin/religion/create', 'ReligionController@create')->name('admin.religion.create');
	Route::post('/admin/religion/store', 'ReligionController@store')->name('admin.religion.store');
	Route::get('/admin/religion/detail/{id}', 'ReligionController@detail')->name('admin.religion.detail');
	Route::get('/admin/religion/edit/{id}', 'ReligionController@edit')->name('admin.religion.edit');
	Route::post('/admin/religion/update', 'ReligionController@update')->name('admin.religion.update');
	Route::post('/admin/religion/delete', 'ReligionController@delete')->name('admin.religion.delete');
	
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