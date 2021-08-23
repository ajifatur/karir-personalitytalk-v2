<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\Test;
use App\Models\CompanyTest;

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
            'code' => 'required',
        ], validationMessages());
        
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
            $company->founded_on = $request->founded_on != '' ? $request->founded_on : null;
            $company->save();
            
            // Save company tests
            if(count($request->get('tests')) > 0){
                foreach($request->get('tests') as $test){
                    $company_test = new CompanyTest;
                    $company_test->company_id = $company->id;
                    $company_test->test_id = $test;
                    $company_test->save();
                }
            }

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
