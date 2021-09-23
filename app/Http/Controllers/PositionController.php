<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Position;
use App\Models\Company;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Test;

class PositionController extends Controller
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

            // Get positions by company
            $positions = $company ? Position::where('company_id','=',$company->id)->get() : Position::all();
        }
        else {
            // Get the user company
            $user_company = Company::where('user_id','=',Auth::user()->id)->first();

            // Get positions by company
            $positions = Position::where('company_id','=',$user_company->id)->get();
        }

        // Get companies
        $companies = Company::all();
        
        // View
        return view('admin/position/index', [
            'positions' => $positions,
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

        // Get roles that have position
        $roles = Role::where('has_position','=',1)->get();

        // Get tests
        $tests = Test::all();

        // View
        return view('admin/position/create', [
            'companies' => $companies,
            'roles' => $roles,
            'tests' => $tests,
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
            'role' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Save the position
            $position = new Position;
            $position->company_id = $request->company;
            $position->role_id = $request->role;
            $position->name = $request->name;
            $position->save();

            // Attach position tests
            if($request->get('tests') != null){
                $position->tests()->attach($request->get('tests'));
            }

            // Attach position skills
            if(array_filter($request->get('skills')) != null){
                foreach(array_filter($request->get('skills')) as $s){
                    $skill = Skill::firstOrCreate(['name' => $s]); // Get skill by name or create
                    $position->skills()->attach($skill->id);
                }
            }

            // Redirect
            return redirect()->route('admin.position.index')->with(['message' => 'Berhasil menambah data.']);
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
        // Get the position
        $position = Position::findOrFail($id);

        // Get companies
        $companies = Company::all();

        // Get roles that have position
        $roles = Role::where('has_position','=',1)->get();

        // Get tests
        $tests = Test::all();

        // View
        return view('admin/position/edit', [
            'position' => $position,
            'companies' => $companies,
            'roles' => $roles,
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
            'company' => 'required',
            'role' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Update the position
            $position = Position::find($request->id);
            $position->company_id = $request->company;
            $position->role_id = $request->role;
            $position->name = $request->name;
            $position->save();

            // Sync position tests
            $position->tests()->sync($request->get('tests'));

            // Sync position skills
            $updatedSkills = [];
            if(array_filter($request->get('skills')) != null){
                foreach(array_filter($request->get('skills')) as $s){
                    $skill = Skill::firstOrCreate(['name' => $s]); // Get skill by name or create
                    array_push($updatedSkills, $skill->id); // Push to array updated skills
                }
            }
            $position->skills()->sync($updatedSkills); // Sync

            // Redirect
            return redirect()->route('admin.position.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        // Get the position
        $position = Position::find($request->id);

        // Detach position skills
        $position->skills()->detach();

        // Detach position tests
        $position->tests()->detach();

        // Delete the position
        $position->delete();

        // Redirect
        return redirect()->route('admin.position.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
