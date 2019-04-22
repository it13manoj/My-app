<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use Hash;
use Session;
use DataTables;
use App\Country;
use App\State;
use App\Category;
use App\SubCategory;
use App\Questionnaire;
use App\JobApplications;
use App\User;
use App\City;
use App\Job;
use App\Company;

class JobController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
        $this->admin_prefix = "admin";
        $this->employer_prefix= "employer";
        $this->candidate_prefix = "candidate";
        $this->manager_prefix = "manager";
    }

    /******************Job Listing**************/
    public function job_listing()
    {
    	return view('Admin.Jobs.jobs');
    }
    public function getadminjobs()
    {
    	 $jobs=DB::table('jobs')
                ->select('jobs.*','companies.company_name','users.user_first_name','users.user_last_name','categories.category_name')
                ->leftjoin('categories','categories.category_id','=','jobs.job_category')
                ->leftjoin('companies','companies.company_id','=','jobs.job_company_id')
                ->leftjoin('users','users.id','=','jobs.job_user_id')
                ->orderBy('created_at','DESC')
                ->get();
       $i=1;
       foreach($jobs as $job){
        $job->serial=$i;
        $job->created_on=date('M d,Y',strtotime($job->created_at));
        $job->applications=JobApplications::where('job_id',$job->job_id)->count();
        $job->userName=$job->user_first_name.' '.$job->user_last_name;
        if($job->published_on!='')
        {
        	$job->published_on=date('M d,Y',strtotime($job->published_on));
        }
        if($job->job_p_category==1)
        {
        	$job->jobcat='Basic';
        }else if($job->job_p_category==2)
        {
        	$job->jobcat="Hot";
        }else
        {
        	$job->jobcat="Featured";
        }
        $i=$i+1;
       }
        return DataTables::of($jobs)
            ->editColumn('status',function($jobs){
                if($jobs->job_status==1){
                    $html='';
                    $html.= '<span id="chngspn'.$jobs->job_id.'"><a style="cursor:pointer" type="button" id="status_'.$jobs->job_id.'" class="change_status" idd="'.$jobs->job_id.'" idd1="4"> <label style="cursor:pointer" class="badge badge-success">Active</label></a></span>';
                            return $html;
                    }else if($jobs->job_status==0)
                    {
                    	$html='';
                    	$html.= '<span id="chngspn'.$jobs->job_id.'"><a style="cursor:pointer" type="button" id="status_'.$jobs->job_id.'" class="change_status" idd="'.$jobs->job_id.'" idd1="1"> <label style="cursor:pointer" class="badge badge-success">Accept</label></a> | ';
                    	$html.= '<a style="cursor:pointer" type="button" id="status_'.$jobs->job_id.'" class="change_status2" idd="'.$jobs->job_id.'" idd1="2"> <label style="cursor:pointer" class="badge badge-danger">Reject</label></a></span>';
                    	return $html;

                    }else if($jobs->job_status==2 || $jobs->job_status==4)
                    {
                    	$html='';
                    	$html.= '<span id="chngspn'.$jobs->job_id.'"><a style="cursor:pointer" type="button" id="status_'.$jobs->job_id.'"  idd="'.$jobs->job_id.'"> <label style="cursor:pointer" class="badge badge-default">Rejected</label></a></span>';
                    	return $html;
                    }
                    else{
                        $html='';
                    $html.= '<span id="chngspn'.$jobs->job_id.'"><a style="cursor:pointer" type="button" id="status_'.$jobs->job_id.'" class="change_status" idd="'.$jobs->job_id.'" idd1="1"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a></span>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($jobs) {
                return '<a target="_blank" href="'.url("/").'/manager/edit_user_job/'.base64_encode($jobs->job_id).'" style="cursor:pointer"  class="btn btn-outline-primary editbtn"><i class="fa fa-edit">Edit</i></a>  <a target="_blank" href="'.url("/").'/jobdetails/'.base64_encode($jobs->job_id).'" style="cursor:pointer"  class="btn btn-outline-primary editbtn"><i class="fa fa-eye">View</i></a>';
              
        })
            ->addColumn('applicationss', function ($jobs) {
                return '<a target="_blank" href="'.url("/").'/manager/managejobapplication/'.base64_encode($jobs->job_id).'" style="cursor:pointer"  class="btn btn-outline-primary editbtn">'.$jobs->applications.'</a>';
              
        })
            ->rawColumns(['status' => 'status','action' => 'action','applicationss'=>'applicationss'])
            ->make(true);
    }

    public function change_job_status(Request $request)
    {
    	$jid=$request->input('id');
    	$status=$request->input('status');
    	$input=array();
    	if($status==1)
    	{
    		$input['published_on']=date('M d,Y');
    	}
      if($status==2)
      {
        $input['reject_reason']=$request->input('reason');
      }
    	$input['job_status']=$status;
    	Job::where('job_id',$jid)->update($input);
    	$html='';
    	if($status==1){
                    $html.='<a style="cursor:pointer" type="button" id="status_'.$jid.'" class="change_status" idd="'.$jid.'" idd1="3"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                }
        else if($status==2)
        {
        	$html.='<a style="cursor:pointer" title="'.$request->input('reason').'" type="button" id="status_'.$jid.'"  idd="'.$jid.'"> <label style="cursor:pointer" class="badge badge-default">Rejected</label></a>';
     	}
     	else{
        	$html.='<a style="cursor:pointer" type="button" id="status_'.$jid.'" class="change_status" idd="'.$jid.'" idd1="1"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
        }
    	return $html;
    }

    public function edit_user_job($id)
    {
    	$results=Job::where('job_id',base64_decode($id))->first();
        $categories=Category::where('category_status',1)->get();
        $questionnaires=Questionnaire::where('user_id',$results->job_user_id)->get();
        return view('Employer.edit_job_post',compact('results','categories','questionnaires'));
    }
    public function update_job(Request $request)
    {
    	$input=array();
       extract($request->all());
       $input['job_title']=$job_title;
       $input['job_category']=$job_category;
       $input['job_sub_category']=$job_sub_category;
       $input['job_career_level']=$job_career_level;
       $input['job_role']=$job_role;
       $input['job_vacancy']=$job_vacancy;
       $input['job_experience']=$job_experience.'-'.$job_experience_max;
       $input['job_last_applying_date']=$job_last_applying_date;
       $input['job_expiry_date']=$job_last_applying_date;
       $input['job_qualification']=$job_qualification;
       $input['job_graduation_start_year']=$job_graduation_start_year;
       $input['job_graduation_end_year']=$job_graduation_end_year;
       $input['job_type']=$job_type;
       $input['job_shift']=$job_shift;
       $input['job_offered_salary_max']=$job_offered_salary_max;
       $input['job_offered_salary_min']=$job_offered_salary_min;
       if($request->has('job_is_salary_disclosed'))
       {
            $input['job_is_salary_disclosed']=$job_is_salary_disclosed; 
       }
       $input['job_address']=$job_location;
       $input['job_description']=$job_description;
       $input['job_responsibility']=$job_responsibility;
       $input['job_skills']=$job_skills;
       if($request->has('job_benefits')){
         $input['job_benefits']=implode(',',$job_benefits);
        }
       $input['job_keywords']=$job_keywords;
       if($request->has('select_questionnaire'))
       {
        $input['job_questionnaire']=$job_questionnaire;
       }
       if($request->has('job_preference')){
        $input['job_preference']=implode(',', $job_preference);
       }
       $input['job_event']=$job_event;
       if($job_event!='Normal')
       {
        $input['job_event_start_date']=$job_event_start_date;
        $input['job_event_end_date']=$job_event_end_date;
        $input['job_event_number_of_companies']=$job_event_number_of_companies;
        if($job_event_companies!=''){
            $input['job_event_companies']=implode(',', $job_event_companies);
        }
       }
       $input['job_p_category']=$job_p_category;
       Job::where('job_id',$job_id)->update($input);
       Session::flash('message', 'Job Updated Successfuly!'); 
       return redirect()->route('job_listing');
    }

    public function add_user_job()
    {
    	$companies=Company::all();
    	$categories=Category::where('category_status',1)->get();
        $questionnaires='';
        return view('Employer.post_job',compact('categories','questionnaires','companies'));
    }

    public function save_user_job(Request $request)
    {
    	$input=array();
       extract($request->all());
       $input['job_title']=$job_title;
       $input['job_user_id']=$job_user_id;
       $input['job_company_id']=$job_company_id;
       $input['job_category']=$job_category;
       $input['job_sub_category']=$job_sub_category;
       $input['job_career_level']=$job_career_level;
       $input['job_role']=$job_role;
       $input['job_vacancy']=$job_vacancy;
       $input['job_experience']=$job_experience.'-'.$job_experience_max;
       $input['job_last_applying_date']=$job_last_applying_date;
       $input['job_expiry_date']=$job_last_applying_date;
       $input['job_qualification']=$job_qualification;
       $input['job_graduation_start_year']=$job_graduation_start_year;
       $input['job_graduation_end_year']=$job_graduation_end_year;
       $input['job_type']=$job_type;
       $input['job_shift']=$job_shift;
       $input['job_offered_salary_max']=$job_offered_salary_max;
       $input['job_offered_salary_min']=$job_offered_salary_min;
       if($request->has('job_is_salary_disclosed'))
       {
            $input['job_is_salary_disclosed']=$job_is_salary_disclosed; 
       }
       $input['job_address']=$job_location;
       $input['job_description']=$job_description;
       $input['job_responsibility']=$job_responsibility;
       $input['job_skills']=$job_skills;
       if($request->has('job_benefits')){
         $input['job_benefits']=implode(',',$job_benefits);
        }
       $input['job_keywords']=$job_keywords;
       if($request->has('select_questionnaire'))
       {
        $input['job_questionnaire']=$job_questionnaire;
       }
       if($request->has('job_preference')){
        $input['job_preference']=implode(',', $job_preference);
       }
       $input['job_event']=$job_event;
       if($job_event!='Normal')
       {
        $input['job_event_start_date']=$job_event_start_date;
        $input['job_event_end_date']=$job_event_end_date;
        $input['job_event_number_of_companies']=$job_event_number_of_companies;
        if($job_event_companies!=''){
            $input['job_event_companies']=implode(',', $job_event_companies);
        }
       }
       $input['job_p_category']=$job_p_category;
       $jid=Job::insertGetId($input);
      Session::flash('message', 'Job Added Successfuly!'); 
       return redirect()->route('job_listing');
    }
    /******************Job Listing**************/
}
