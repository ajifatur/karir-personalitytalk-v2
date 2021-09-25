<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Applicant;
use App\Models\Attachment;
use App\Models\Company;
use App\Models\Position;
use App\Models\Relationship;
use App\Models\Religion;
use App\Models\Role;
use App\Models\User;
use App\Models\Vacancy;

class ApplicantController extends Controller
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

            // Get applicants by company
            $applicants = $company ? Applicant::where('company_id','=',$company->id)->orderBy('updated_at','desc')->get() : Applicant::orderBy('updated_at','desc')->get();
        }
        else {
            // Get the user company
            $user_company = Company::where('user_id','=',Auth::user()->id)->first();

            // Get applicants by company
            $applicants = Applicant::where('company_id','=',$user_company->id)->orderBy('updated_at','desc')->get();
        }

        // Get companies
        $companies = Company::all();
        
        // View
        return view('admin/applicant/index', [
            'applicants' => $applicants,
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

        // Get religions
        $religions = Religion::all();

        // Get relationships
        $relationships = Relationship::all();

        // View
        return view('admin/applicant/create', [
            'companies' => $companies,
            'religions' => $religions,
            'relationships' => $relationships,
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
            'identity_number' => $request->identity_number != '' ? 'numeric' : '',
            'vacancy' => 'required',
            'religion' => 'required',
            'relationship' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Get the vacancy
            $vacancy = Vacancy::find($request->vacancy);

            // Generate username
            $role_has_no_access = Role::where('has_access','=',0)->pluck('id')->toArray();
            $latest_user = User::whereIn('role_id',$role_has_no_access)->where('username','like',$vacancy->company->code.'%')->latest('username')->first();
            $generated_username = $latest_user ? generate_username($latest_user->username, $vacancy->company->code) : generate_username(null, $vacancy->company->code);

            // Save the user
            $user = new User;
            $user->role_id = $vacancy ? $vacancy->position->role_id : 0;
            $user->name = $request->name;
            $user->birthdate = generate_date_format($request->birthdate, 'y-m-d');
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
            $user->save();

            // Save the applicant
            $applicant = new Applicant;
            $applicant->user_id = $user->id;
            $applicant->company_id = $vacancy ? $vacancy->company->id : 0;
            $applicant->position_id = $vacancy ? $vacancy->position->id : 0;
            $applicant->vacancy_id = $request->vacancy;
            $applicant->religion_id = $request->religion;
            $applicant->relationship_id = $request->relationship;
            $applicant->identity_number = $request->identity_number;
            $applicant->latest_education = $request->latest_education;
            $applicant->job_experiences = $request->job_experiences;
            $applicant->save();

            // Redirect
            return redirect()->route('admin.applicant.index')->with(['message' => 'Berhasil menambah data.']);
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
        // Get the applicant
        $applicant = Applicant::findOrFail($id);

        // Get religions
        $religions = Religion::all();

        // Get relationships
        $relationships = Relationship::all();

        // Get attachments
        $attachments = Attachment::orderBy('num_order','asc')->get();

        // View
        return view('admin/applicant/edit', [
            'applicant' => $applicant,
            'religions' => $religions,
            'relationships' => $relationships,
            'attachments' => $attachments,
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
            'birthdate' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'identity_number' => $request->identity_number != '' ? 'numeric' : '',
            'vacancy' => 'required',
            'religion' => 'required',
            'relationship' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Get the vacancy
            $vacancy = Vacancy::find($request->vacancy);

            // Update the applicant
            $applicant = Applicant::find($request->id);
            $applicant->position_id = $vacancy ? $vacancy->position->id : 0;
            $applicant->vacancy_id = $request->vacancy;
            $applicant->religion_id = $request->religion;
            $applicant->relationship_id = $request->relationship;
            $applicant->identity_number = $request->identity_number;
            $applicant->latest_education = $request->latest_education;
            $applicant->job_experiences = $request->job_experiences;
            $applicant->save();

            // Update the user
            $user = User::find($applicant->user_id);
            $user->name = $request->name;
            $user->birthdate = generate_date_format($request->birthdate, 'y-m-d');
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email;
            $user->save();

            // Redirect
            return redirect()->route('admin.applicant.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        // Get the applicant
        $applicant = Applicant::find($request->id);
        
        // Get the user
        $user = User::find($applicant->user_id);

        // Delete the applicant
        $applicant->delete();

        // Delete the user
        $user->delete();

        // Redirect
        return redirect()->route('admin.applicant.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
