<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobseeker;
use App\Models\Job;
use App\Models\Jobapplication;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Adduser(Request $request)
    {
        $name=$request->post('name');
        $email=$request->post('email');
        $password=$request->post('password');
        $phone=$request->post('phone');
        $cv=$request->file('cv');

        $fileName=$cv->getClientOriginalName();
        $destinationPath=public_path('/CV'); //store in a new folder 'CV'
        $cv->move($destinationPath,$fileName);

        $new_user= new Jobseeker();
        $new_user->name=$name;
        $new_user->email=$email;
        $new_user->password=$password;
        $new_user->phone=$phone;
        $new_user->cv=$fileName;
        $emailexists=Jobseeker::where(["email"=>$email])->get();
        if(count($emailexists)==1)
        {
            return back()->with("success","Email already exists! ");
        }
        else
        {
            $new_user->save();
            return Redirect::to('/userLogin');
        }
        
    }
    public function Userlogin(Request $request)
    {
        $email= $request->post('email'); 
        $password=$request->post('password');
        $userlogin=Jobseeker::where(["email"=>$email, "password"=>$password])->get();
            if(count($userlogin)==1)
            {
                $getid=Jobseeker::where(["email"=>$email,"password"=>$password])->first();
                $userid=$getid->id;
                $request->session()->put("userId",$userid);
                $request->session()->put("UserEmail",$email);
                $request->session()->put("userName",$getid->name); //name from table
                $request->session()->put('roleId',$getid->roleId);
                return Redirect:: to('/userHome');
            }
         else
            {
                echo "Invalid email or password";
            }
    }
    public function Recentjobs()
    {
        $jobs=Job::all()->SortByDesc("updated_at");
        return view('Jobseeker.user_recentjoblisting',['job'=> $jobs]);

    }
    public function Searchbycity(Request $request)
    {
        $search=$request->post('city');
        $jobs=Job::where('city', 'LIKE','%'.$search.'%')->get();
        if(count($jobs)>0)
        {
           return view('Jobseeker.user_searchjobs')->withDetails($jobs)->withQuery($search);
            
        }
        else 
        {
                return view ('Jobseeker.user_searchjobs')->withMessage('No Details found. Try searching again !');
        }
    }
  
     public function Advancedsearch(Request $request)
    {
    
       $jobs = Job::query();
        if($request->has('keyword'))
        {
           $jobs->where(function($query) use($request) 
            {
                $query->orWhere('city', 'LIKE', "%{$request->keyword}%" )
                    ->orWhere ( 'title', 'LIKE', "%{$request->keyword}%" )
                    ->orWhere ( 'category', 'LIKE', "%{$request->keyword}%" )
                    ->orWhere ( 'qualification', 'LIKE', "%{$request->keyword}%" )
                    ->orWhere ( 'company', 'LIKE', "%{$request->keyword}%");
            });
        }
        if($request->has('city'))
        {
            $jobs->where(function($query) use($request) 
            {
                $query->where('city', 'LIKE', "%{$request->city}%" );
            });
        }
        
         $jobs=$jobs->get();
         if(count($jobs)>0)
        {
           return view('Jobseeker.user_searchjobs')->withDetails($jobs)->withQuery($request->keyword);
            
        }
        else 
        {
                return view ('Jobseeker.user_searchjobs')->withMessage('No Details found. Try searching again !');
        }
    }
    public function searchjobs(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $jobs = Job::query();
            if($request->has('keyword'))
            {
               $jobs->where(function($query) use($request) 
                {
                    $query->orWhere('city', 'LIKE', "%{$request->keyword}%" )
                        ->orWhere ( 'title', 'LIKE', "%{$request->keyword}%" )
                        ->orWhere ( 'category', 'LIKE', "%{$request->keyword}%" )
                        ->orWhere ( 'qualification', 'LIKE', "%{$request->keyword}%" )
                        ->orWhere ( 'company', 'LIKE', "%{$request->keyword}%");
                });
            }
            if($request->has('city'))
            {
                $jobs->where(function($query) use($request) 
                {
                    $query->where('city', 'LIKE', "%{$request->city}%" );
                });
            }
            if($request->has('category'))
            {
                $jobs->where(function($query) use($request) 
                {
                    $query->where('category', 'LIKE', "%{$request->category}%" );
                });
            }
            
            $jobs=$jobs->get();

            if($jobs)
            {
                foreach($jobs as $key =>$job) 
                {
                $output.='<tr>'.
                '<td>'.$job->category.'</td>'.
                '<td>'.$job->title.'</td>'.
                '<td>'.$job->city.'</td>'.
                '<td>'.$job->company.'</td>'.
                '<td><a href="/Jobapply/'.$job->id.'" class="edit" title="click">Quick Apply</a></td>'.
                '</tr>';
                }
                return Response($output);
                //echo $output;
            }
        }
    }
    public function Applyjob(Request $request, $id)
    {
        $job_id=$id;
        if ($request->session()->has('userId')) 
        {
            $jobseeker_id=$request->session()->get("userId");
            $jobapply= new Jobapplication();
            $jobapply->jobseeker_id=$jobseeker_id;
            $jobapply->job_id=$job_id;
          /*  $jobapply->save();
            return back()->with("success","Successfully Applied");*/

            //check existing jobseeker_id and job_id combo

            $user_jobapply = Jobapplication::where('job_id',$id)
                                ->where('jobseeker_id', $jobseeker_id)
                                ->exists();
            if ($user_jobapply==false)
            {
                $jobapply->save();
                return back()->with("success","Successfully Applied");
            }
            else
            {
                return back()->with("success","Already applied for this job");
            }
        
        }
        
        else
            { 
                echo "Please login to apply";
            }          
    }
    public function Viewjobdescription($id)
    {
        $job=Job::find($id);
        return view('Jobseeker.user_jobdescription',["job"=>$job]);
    }
    public function Applyjobfromanotherpage(Request $request)
    {
        $job_id=$request->post("hid");
        if ($request->session()->has('userId')) 
        {
            $jobseeker_id=$request->session()->get("userId");
            $jobapply= new Jobapplication();
            $jobapply->jobseeker_id=$jobseeker_id;
            $jobapply->job_id=$job_id;
          /*  $jobapply->save();
            return back()->with("success","Successfully Applied");*/

            //check existing jobseeker_id and job_id combo

            $user_jobapply = Jobapplication::where('job_id',$job_id)
                                ->where('jobseeker_id', $jobseeker_id)
                                ->exists();
            if ($user_jobapply==false)
            {
                $jobapply->save();
                return back()->with("message","Successfully applied for this job");
            }
            else
            {
                return back()->with("message","Already applied for this job");
            }
        
        }
        
        else
        { 
               return back()->with("message","Please login to apply");
                // echo "Please login to apply";
        }          
    }
}
