<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Position;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role->id == role('admin')) {
            // Get the company by query
            $company = Company::find($request->query('company'));

            // Get vacancies by company
            $vacancies = $company ? Vacancy::where('company_id','=',$company->id)->get() : Vacancy::all();
        }
        else {
            // Get the user company
            $user_company = Company::where('user_id','=',Auth::user()->id)->first();

            // Get vacancies by company
            $vacancies = Vacancy::where('company_id','=',$user_company->id)->get();
        }

        // Get companies
        $companies = Company::all();
        
        // View
        return view('admin/vacancy/index', [
            'vacancies' => $vacancies,
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get companies
        $companies = Company::all();

        // View
        return view('admin/vacancy/create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Get company
            $company = Position::find($request->position)->company;

            // Save the vacancy
            $vacancy = new Vacancy;
            $vacancy->company_id = $company ? $company->id : 0;
            $vacancy->position_id = $request->position;
            $vacancy->code = Str::random(20);
            $vacancy->start_date = generate_date_format($request->start_date, 'y-m-d');
            $vacancy->end_date = generate_date_format($request->end_date, 'y-m-d');
            $vacancy->save();

            // Redirect
            return redirect()->route('admin.vacancy.index')->with(['message' => 'Berhasil menambah data.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the vacancy
        $vacancy = Vacancy::findOrFail($id);

        // Get companies
        $companies = Company::all();

        // View
        return view('admin/vacancy/edit', [
            'vacancy' => $vacancy,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Get company
            $company = Position::find($request->position)->company;

            // Update the vacancy
            $vacancy = Vacancy::find($request->id);
            $vacancy->company_id = $company ? $company->id : 0;
            $vacancy->position_id = $request->position;
            $vacancy->start_date = generate_date_format($request->start_date, 'y-m-d');
            $vacancy->end_date = generate_date_format($request->end_date, 'y-m-d');
            $vacancy->save();

            // Redirect
            return redirect()->route('admin.vacancy.index')->with(['message' => 'Berhasil mengupdate data.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Get the vacancy
        $vacancy = Vacancy::find($request->id);

        // Delete the vacancy
        $vacancy->delete();

        // Redirect
        return redirect()->route('admin.vacancy.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
