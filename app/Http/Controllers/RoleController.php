<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get roles
        $roles = Role::all();
        
        // View
        return view('admin/role/index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View
        return view('admin/role/create');
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
            'code' => 'required|alpha_dash|unique:roles',
            'has_access' => 'required',
            'has_position' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Save the role
            $role = new Role;
            $role->name = $request->name;
            $role->code = $request->code;
            $role->has_access = $request->has_access;
            $role->has_position = $request->has_position;
            $role->created_at = date('Y-m-d H:i:s');
            $role->updated_at = date('Y-m-d H:i:s');
            $role->save();

            // Redirect
            return redirect()->route('admin.role.index')->with(['message' => 'Berhasil menambah data.']);
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
            $role->updated_at = date('Y-m-d H:i:s');
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
