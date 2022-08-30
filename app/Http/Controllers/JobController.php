<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Traits\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Jobs::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$request->validate([
            "job_title" => "required|max:50",
            "company_name" => "required",
            "tags" => "required",
            "sector" => "required",
            "application_type" => "required",
            "application_deadline" => "required",
            "is_urgent" => "required",
            "role" => "required",
            "experience" => "required",
            "qualification" => "required",
            "max_salary" => "required",
            "state" => "required",
        ]);*/

        if( $file = $request->file('image') ) {
            $path = 'employer_logos/images';
            $url = $this->FileUpload($file,$path,300,400);
        }

        //generate random uuid for foreignkeys
         $foreignid  = (string) Str::uuid();

        $input = new Jobs;
        $input->user_id = 1;
        $input->job_id = $foreignid;
        $input->job_title = $request->input('job_title');
        $input->company_name = $request->input('company_name');
        $input->tags = $request->input('tags');
        $input->sector = $request->input('sector');
        $input->application_type = $request->input('application_type');
        $input->application_deadline = $request->input('application_deadline');
        $input->apply_email = $request->input('apply_email');
        $input->is_urgent = $request->input('is_urgent');
        $input->is_filled = $request->input('is_filled');
        $input->status = $request->input('status');
        $input->company_logo = $request->input('company_logo');

        $input->save();
        
        return response()->json($input, 200);
        //add job Requirement

       /* $job_descr = new Jobs_location;
        $job_descr->jobs_id = $foreignid;
        $job_descr->role = $request->role;
        $job_descr->experience = $request->experience;
        $job_descr->qualification = $request->qualification;
        $job_descr->gender = $request->gender;
        $job_descr->career_level = $request->career_level; **/
        //$response->assertStatus(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Jobs::find($id);
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
