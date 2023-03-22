<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Jobapplication;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use session;


class EmployerController extends Controller
{
    public function Addemployer(Request $request)
    {
         $this->validate($request, [
            'fname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'company' => 'required',            
            'company' => 'required',
            'phone' => 'required'
        ]);
        $name=$request->post('fname');
        $email=$request->post('email');
        $password=$request->post('password');
        $company=$request->post('company');
        $phone=$request->post('phone');

        $employer= new Employer();
        $employer->name=$name;
        $employer->email=$email;
        $employer->password=$password;
        $employer->company=$company;
        $employer->phone=$phone;
        $emailexists=Employer::where(["email"=>$email])->get();
        if(count($emailexists)==1)
        {
            return back()->with("Msg","Email already exists! ");
        }
        else
        {
             $employer->save();
             return Redirect:: to('/employerLogin');
        }
            
    }
     public function login(Request $request)
    {
       
        $email= $request->post('email'); 
        $password=$request->post('password');
        $employerlogin=Employer::where(["email"=>$email, "password"=>$password])->get();
            if(count($employerlogin)==1)
            {
                $getid=Employer::where(["email"=>$email,"password"=>$password])->first();
                $employerId=$getid->id;
                $request->session()->put("EmployerId",$employerId);
                $request->session()->put("Employeremail",$email);
                $request->session()->put("Employername",$getid->name); //name from table
                return Redirect:: to('/employerHome');
            }
         else
            {
                echo "Invalid email or password";
            }
    }
    public function Postjob(Request $request )
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required',
            'city' => 'required',
            'zipcode' => 'required',            
            'company' => 'required',
            'qualification' => 'required',
            'description' => 'required'
        ]);
        $employerid=session()->get("EmployerId");
        $category=$request->post('category');
        $title=$request->post('title');
        $city=$request->post('city');
        $zipcode=$request->post('zipcode');
        $company=$request->post('company');
        $qualification=$request->post('qualification');
        $description=$request->post('description');

        $newjob= new Job();
        $newjob->employer_id=$employerid;
        $newjob->category=$category;
        $newjob->title=$title;
        $newjob->city=$city;
        $newjob->zipcode=$zipcode;
        $newjob->company=$company;
        $newjob->qualification=$qualification;
        $newjob->description=$description;
        $newjob->save();
        return back()->with("success","Successfully posted");


    }
    public function Listjobs(Request $request)
    {
        if ($request->session()->has('EmployerId')) 
        {
            $employer_id=$request->session()->get("EmployerId");
            $myjobpost=Job::where('employer_id','LIKE','%'.$employer_id.'%')->get();
            if(count($myjobpost)>0)
            {
                return view('Employer.employer_listjobs',['myjobpost'=>$myjobpost]);
            }
            else
            {
                 //return Redirect::to ('/employerPostjob');
                 return Redirect::back()->withErrors(['ErrorMsg' => 'No posts yet!']);
                 //echo "No posts yet!";
            }
        }
        else
        {
            return Redirect::to ('/employerLogin');
        }
    }
    public function ViewApplicants(Request $request, $id)
    {
         if ($request->session()->has('EmployerId')) 
        {   
            // SELECT jobseekers.name, jobseekers.email FROM jobapplications INNER JOIN jobseekers on (jobapplications.jobseeker_id=jobseekers.id) where jobapplications.job_id='5'

            $job_id=$id;
            $jobapplicants=Jobapplication::select('jobseekers.name','jobseekers.email','jobseekers.phone','jobseekers.cv')
            ->join( 'jobseekers','jobseekers.id','=', 'jobapplications.jobseeker_id')
            ->where('jobapplications.job_id',$job_id)->get();
            if(count($jobapplicants)>0)
            {
                return view('Employer.employer_viewjobapplicants',['jobapplicants'=>$jobapplicants]);
            }
            else
            {
                return back()->with("ErrorMsg","No applicants yet!"); 
            }

        }
        else
        {
            return Redirect::to ('/employerLogin');
        }

    }
   
    
}
