<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\Office;
use App\Models\Test;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get companies
        $companies = Company::all();
        
        // View
        return view('admin/company/index', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get tests
        $tests = Test::all();

        // View
        return view('admin/company/create', [
            'tests' => $tests
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
            'name' => 'required|max:255',
            'code' => 'required|unique:companies|min:3',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Save the company
            $company = new Company;
            $company->name = $request->name;
            $company->code = $request->code;
            $company->address = $request->address;
            $company->phone_number = $request->phone_number;
            $company->founded_on = $request->founded_on != '' ? generate_date_format($request->founded_on, 'y-m-d') : null;
            $company->save();

            // Attach company tests
            if($request->get('tests') != null){
                $company->tests()->attach($request->get('tests'));
            }

            // Save the office
            $office = new Office;
            $office->company_id = $company->id;
            $office->name = 'Head Office';
            $office->address = '';
            $office->phone_number = '';
            $office->founded_on = $request->founded_on != '' ? generate_date_format($request->founded_on, 'y-m-d') : null;
            $office->save();

            // Redirect
            return redirect()->route('admin.company.index')->with(['message' => 'Berhasil menambah data.']);
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
        // Get the company
        $company = Company::findOrFail($id);

        // Get tests
        $tests = Test::all();

        // View
        return view('admin/company/edit', [
            'company' => $company,
            'tests' => $tests,
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
            'name' => 'required|max:255',
            'code' => 'required|unique:companies|min:3',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Update the company
            $company = Company::find($request->id);
            $company->name = $request->name;
            $company->code = $request->code;
            $company->address = $request->address;
            $company->phone_number = $request->phone_number;
            $company->founded_on = $request->founded_on != '' ? generate_date_format($request->founded_on, 'y-m-d') : null;
            $company->save();

            // Sync company tests
            $company->tests()->sync($request->get('tests'));

            // Redirect
            return redirect()->route('admin.company.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        // Get the company
        $company = Company::find($request->id);

        // Detach company tests
        $company->tests()->detach();

        // Delete the company
        $company->delete();

        // Redirect
        return redirect()->route('admin.company.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
