<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get employees
        $employees = Employee::all();
        
        // View
        return view('admin/employee/index', [
            'employees' => $employees
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
        return view('admin/employee/create', [
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
            'birthdate' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'position' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Get the position
            $position = Position::find($request->position);

            // Generate username
            $company = Company::find($position->company->id);
            $role_has_no_access = Role::where('has_access','=',0)->pluck('id')->toArray();
            $latest_user = User::whereIn('role_id',$role_has_no_access)->where('username','like',$position->company->code.'%')->latest('username')->first();
            $generated_username = $latest_user ? generate_username($latest_user->username, $position->company->code) : generate_username(null, $position->company->code);

            // Save the user
            $user = new User;
            $user->role_id = $position ? $position->role_id : 0;
            $user->name = $request->name;
            $user->birthdate = $request->birthdate;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email;
            $user->username = $generated_username;
            $user->password = bcrypt($generated_username);
            $user->access_token = Str::random(32);
            $user->photo = null;
            $user->status = 1;
            $user->last_visit = null;
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();

            // Save the employee
            $employee = new Employee;
            $employee->user_id = $user->id;
            $employee->company_id = $position->company->id;
            $employee->office_id = 0;
            $employee->position_id = $request->position;
            $employee->identity_number = $request->identity_number;
            $employee->latest_education = $request->latest_education;
            $employee->start_date = $request->start_date != '' ? generate_date_format($request->start_date, 'y-m-d') : null;
            $employee->end_date = $request->end_date != '' ? generate_date_format($request->end_date, 'y-m-d') : null;
            $employee->created_at = date('Y-m-d H:i:s');
            $employee->updated_at = date('Y-m-d H:i:s');
            $employee->save();

            // Redirect
            return redirect()->route('admin.employee.index')->with(['message' => 'Berhasil menambah data.']);
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
        // Get the role
        $role = Role::findOrFail($id);

        // View
        return view('admin/role/edit', [
            'role' => $role
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
            'code' => 'required|alpha_dash',
            'has_access' => 'required',
            'has_position' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Update the role
            $role = Role::find($request->id);
            $role->name = $request->name;
            $role->code = $request->code;
            $role->has_access = $request->has_access;
            $role->has_position = $request->has_position;
            $role->save();

            // Redirect
            return redirect()->route('admin.role.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        // Get the role
        $role = Role::find($request->id);

        // Delete the role
        $role->delete();

        // Redirect
        return redirect()->route('admin.role.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
