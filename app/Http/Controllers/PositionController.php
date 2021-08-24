<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Position;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get positions
        $positions = Position::all();
        
        // View
        return view('admin/position/index', [
            'positions' => $positions
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
        return view('admin/office/create', [
            'companies' => $companies
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
            'company' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Save the office
            $office = new Office;
            $office->company_id = $request->company;
            $office->name = $request->name;
            $office->address = $request->address;
            $office->phone_number = $request->phone_number;
            $office->founded_on = $request->founded_on != '' ? generate_date_format($request->founded_on, 'y-m-d') : null;
            $office->save();

            // Redirect
            return redirect()->route('admin.office.index')->with(['message' => 'Berhasil menambah data.']);
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
        // Get the office
        $office = Office::findOrFail($id);

        // Get companies
        $companies = Company::all();

        // View
        return view('admin/office/edit', [
            'office' => $office,
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
            'name' => 'required|max:255',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Update the office
            $office = Office::find($request->id);
            $office->name = $request->name;
            $office->address = $request->address;
            $office->phone_number = $request->phone_number;
            $office->founded_on = $request->founded_on != '' ? generate_date_format($request->founded_on, 'y-m-d') : null;
            $office->save();

            // Redirect
            return redirect()->route('admin.office.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        // Get the office
        $office = Office::find($request->id);

        // Delete the office
        $office->delete();

        // Redirect
        return redirect()->route('admin.office.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
