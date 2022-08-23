<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\FileUpload;

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
        //return ['message' => 'Barnabas welcome to API'];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
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
        ]);

        if( $file = $request->file('image') ) {
            $path = 'employer_logos/images';
            $url = $this->FileUpload($file,$path,300,400);
        }


        $input = new Job;
        $input->user_id = Auth->user();
        $input->job_id = (string) Str::uuid();
        $input->job_tile = $request->job_title;
        $input->company_name = $request->company_name;
        $input->tags = $request->tags;
        $input->sector = $request->sector;
        $input->application_type = $request->application_type;
        $input->application_deadline = $request->application_deadline;
        $input->apply_email = $request->apply_email;
        $input->is_urgent = $request->is_urgent;
        $input->is_filled = $request->is_filled;
        $input->status = $request->status;
        $input->company_logo = $url;

        //add job Requirement

        $job_descr = new Jobs_location;
        $job_descr->job_id = think;
    }

    /**
     * Display the specif
        $input->ied resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
