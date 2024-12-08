<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\ListingApplication;
use App\Mail\ListingApplicationCompanyMail;

class ListingApplicationController extends Controller
{
    public function apply(Request $request, $id) {
        //return response()->json(['message' => 'Not implemented yet, but we got here']);
        try{
            $validateApplication = $request->validate([
                'resume' => 'required|mimetypes:application/pdf',
                'cover_letter' => 'nullable|mimetypes:application/pdf',
            ]);
            $validateApplication['resume'] = $request->file('resume')->store('resumes');
            $validateApplication['cover_letter'] = $request->file('cover_letter')->store('cover_letters');
            $validateApplication['status'] = 'applied';
            $validateApplication['user_id'] = auth()->user()->id;
            $validateApplication['listing_id'] = $id;
    
            $application = ListingApplication::create($validateApplication);
            
            //dispatch emails to both company and applicant
    
            $companyData = Listing::where('id', $id)->firstOrFail();
            $userEmail = auth()->user()->email;
            $companyName = $companyData->company;
            $companyEmail = $companyData->email;
            $userName = auth()->user()->name;
            $jobName = $companyData->job_title;
            $emailData = [
                "companyName" => $companyName,
                "userName" => $userName,
                "jobName" => $jobName,
                "userEmail" => $userEmail,
                "companyEmail" => $companyEmail,
                // "message" => "Hello $companyName, <br> <br> $userName has applied for the job $jobName. <br> <br> Please find the attached resume and cover letter. <br> <br> Thank you, <br> $userName",
                // "messageUser" => "Hello $userName, <br> <br> You have successfully applied for the job $jobName. <br> <br> Please find the attached resume and cover letter. <br> <br> Thank you, <br> $companyName",
            ];
    
            try{
                $Mail::to($companyEmail)->send(new ListingApplicationCompanyMail($emailData));
                Mail::to($userEmail)->send(new ListingApplicationMail($emailData));
                
            }
            catch(\Exception $e){
                return response()->json(['message' => 'Application submitted, but email failed: ' . $e->getMessage()], 500);
            }
            
    
            return response()->json([
                'message' => 'Application submitted successfully',
            ], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
        
    }
}
