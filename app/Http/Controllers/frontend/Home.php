<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\Category;
use App\SubCategory;
use App\City;
use App\Questionnaire;
use App\Job;
use App\User;
use App\Company;
use App\SavedJobs;
use App\JobApplications;
use Hash;
use Mail;
use DB;

class Home extends Controller
{
    public function __construct()
    {
    //    $this->middleware('auth');
    }


    public function home()
    {
        return view('landing');
    }
    public function fetchCompanies(Request $request){
    	$compname=$request->input('compname');
    	$com = Company::select('company_name')->where('company_name', 'like', '%' .$compname. '%')->get();
        return request()->json(200,$com);
    }
    public function checkAuthentication(Request $request){
        if($request->input('type')=='email'){
            $chck=User::where('email',$request->input('val'))->first();
            if($chck){
                return 0;
            }else{
                return 1;
            }
        }else{
            $chck=User::where('user_contact',$request->input('val'))->first();
            if($chck){
                return 0;
            }else{
                return 1;
            }
        }
       // return 1;
    }
    public function register_employer(Request $request){
        $user_token=md5(rand());
        $user_email=$request->input('user_email');
        $em=explode('@',$user_email);
        $user_username=$em[0];
        $chck=Company::where('company_name',$request->input('user_company'))->first();
        $input=array();
        if($chck){
            $comp=$chck->company_id;
        }else{
            $fn=str_replace(' ', '-', $request->input('user_company'));
            $dt=strtotime(now());
            $company_slug=$fn.'-'.$dt;
            $comp=Company::insertGetId(array('company_name'=>$request->input('user_company'),'company_slug'=>$company_slug));
            $input['user_can_edit_comp']=1;
        }
            
            $input['user_first_name'] = $request->input('user_first_name');
            $input['user_last_name'] =  $request->input('user_last_name');
            $input['email'] = $user_email;
            $input['user_role']=$request->input('user_role');
            $input['user_token']=$user_token;
            $fn=str_replace(' ', '-', $request->input('user_first_name'));
            $lfn=str_replace(' ', '-', $request->input('user_last_name'));
            $dt=strtotime(now());
            $input['user_slug']=$fn.'-'.$lfn.'-'.$dt;
            $input['user_company']=$comp;
            $input['user_username']=$user_username;
            $input['user_status']=0;
            $input['user_designation']=$request->input('user_designation');
            $input['user_contact']=$request->input('user_contact');
            $input['password'] = Hash::make($request->input('password'));
           return $rec=User::insertGetId($input);
         
    }
    /***********View employer profile***************/
    public function employerprofile(Request $request,$slug){
           $result=DB::table('users')
                    ->select('users.*','companies.company_id','companies.company_slug','companies.company_name','companies.company_logo')
                    ->join('companies','companies.company_id','=','users.user_company')
                    ->where('users.user_slug',$slug)->first();
            $totaljobs=Job::where('job_user_id',$result->id)->count();
            $totalactivejobs=Job::where(array('job_user_id'=>$result->id,'job_status'=>1))->count();
            $jobs=Job::where('job_user_id',$result->id)->get();
           return view('Employer.profile',compact('result','jobs','totalactivejobs','totaljobs'));
    }
    /***********View employer profile***************/
    public function fetchsubcats(Request $request){
        $recs=SubCategory::where(array('category_id'=>$request->input('category_id'),'subcategory_status'=>1))->get();
        $html='';
        if(sizeof($recs)>0){
            $html.='<option value="">Select</option>';
            foreach ($recs as $rec) {
                $html.='<option value="'.$rec->subcategory_id.'">'.$rec->subcategory_name.'</option>';
            }
        }else{
                $html.='<option value="">No Records found</option>';
        }
        return $html;
    }
    public function fetchstates(Request $request){
        $recs=State::where('country_id',$request->input('country_id'))->get();
        $html='';
        if(sizeof($recs)>0){
            $html.='<option value="">Select</option>';
            foreach ($recs as $rec) {
                $html.='<option value="'.$rec->state_id.'">'.$rec->state_name.'</option>';
            }
        }else{
                $html.='<option value="">No Records found</option>';
        }
        return $html;
    }
    public function fetchcities(Request $request){
        $recs=City::where('state_id',$request->input('state_id'))->get();
        $html='';
        if(sizeof($recs)>0){
            $html.='<option value="">Select</option>';
            foreach ($recs as $rec) {
                $html.='<option value="'.$rec->city_id.'">'.$rec->city_name.'</option>';
            }
        }else{
                $html.='<option value="">No Records found</option>';
        }
        return $html;
    }
    public function fetchusersofcompany(Request $request)
    {
        $recs=User::where('user_company',$request->input('company_id'))->get();
        $html='';
        if(sizeof($recs)>0){
            $html.='<option value="">Select</option>';
            foreach ($recs as $rec) {
                $html.='<option value="'.$rec->id.'">'.$rec->user_first_name.' '.$rec->user_last_name.'</option>';
            }
        }else{
                $html.='<option value="">No Records found</option>';
        }
        return $html;
    }
    public function fetchquestionnaire(Request $request)
    {
        $recs=Questionnaire::where('user_id',$request->input('user_id'))->get();
        $html='';
        if(sizeof($recs)>0){
            $html.='<option value="">Select</option>';
            foreach ($recs as $rec) {
                $html.='<option value="'.$rec->questionnaire_id.'">'.$rec->questionnaire_title.'</option>';
            }
        }else{
                $html.='<option value="">No Records found</option>';
        }
        return $html;
    }

    public function fetchcitiesforjob(Request $request)
    {
        $cityn=$request->input('city');
        $com = City::select('city_name','city_id')->where('city_name', 'like', '%' .$cityn. '%')->limit(10)->get();
        return response()->json($com);
    }

    /************Register candidate**********/
    public function register_candidate(Request $request)
    {
        $user_token=md5(rand());
        $user_email=$request->input('user_email');
        $em=explode('@',$user_email);
        $user_username=$em[0];
        $input=array();
            $input['user_first_name'] = $request->input('user_first_name');
            $input['user_last_name'] =  $request->input('user_last_name');
            $input['email'] = $user_email;
            $input['user_role']='Jobseeker';
            $input['candidate_type']=$request->input('user_role');
            $input['user_token']=$user_token;
            $fn=str_replace(' ', '-', $request->input('user_first_name'));
            $lfn=str_replace(' ', '-', $request->input('user_last_name'));
            $dt=strtotime(now());
            $input['user_slug']=$fn.'-'.$lfn.'-'.$dt;
            $input['user_username']=$user_username;
            $input['user_status']=1;
            $input['user_contact']=$request->input('user_contact');
            $input['password'] = Hash::make($request->input('password'));

            $toemail = $input['email'];
            $appname=\Config::get('app.name');
                $secidtoview = array('id' => $input['user_token'],'name' => $input['user_first_name']);
                Mail::send('emails.reg',$secidtoview,function($message) use ($toemail,$appname) {
                    $message->to($toemail)->subject('Account Verification')->from('admin@naukriyan.com',$appname);
                });
           return $rec=User::insertGetId($input);
    }
    /************Register candidate**********/
    /************Verify User****************/
    public function verifyUser($id)
    {
        $user=User::where('user_token',$id)->first();
        if($user)
        {
            $user_token=md5(rand());
            User::where('user_token',$id)->update(array('user_token'=>$user_token,'is_email_verified'=>1));
            return view('emailverified');
        }else
        {
            return redirect('userlogin');
        }
    }
    /************Verify User****************/

    /************Get jobs for homepage********/
    public function gethomepagejobs(Request $request)
    {
        $type=$request->input('access_token');
        $userid=base64_decode($request->input('reqId'));
             $jobs=DB::table('jobs')
                ->join('companies','companies.company_id','jobs.job_company_id')
                ->where(array('job_category'=>$type,'job_status'=>'1'))->limit(10)->get();
        /*if($type=='Hot'){
             $jobs=DB::table('jobs')
                ->join('companies','companies.company_id','jobs.job_company_id')
                ->where(array('job_p_category'=>'2','job_status'=>'1'))->limit(10)->get();
        }
        if($type=='JobFair'){
             $jobs=DB::table('jobs')
                ->join('companies','companies.company_id','jobs.job_company_id')
                ->where(array('job_event'=>'Job-fair','job_status'=>'1'))->limit(10)->get();
        }*/
        if($jobs){
            foreach($jobs as $job)
            {
                $job->encId=base64_encode($job->job_id);
                $similarsaved=SavedJobs::where(array('user_id'=>$userid,'job_id'=>$job->job_id))->count();
                if($similarsaved>0)
                {
                    $job->isSaved=1;
                }else
                {
                    $job->isSaved=0;
                }
                $similarapplied=JobApplications::where(array('user_id'=>$userid,'job_id'=>$job->job_id))->count();
                if($similarapplied>0)
                {
                    $job->isApplied=1;
                }else
                {
                    $job->isApplied=0;
                }
            }
        }
        return $jobs;
    }
    /************Get Jobs for homepage********/
    public function sendresetpasswordmail(Request $request)
    {
        $email=$request->input('user_email');
        $userd=User::where('email',$email)->first();
        $toemail = $email;
        $appname=\Config::get('app.name');
        $secidtoview = array('id' => $userd->user_token,'name' => $userd->user_first_name);
        Mail::send('emails.forgotpass',$secidtoview,function($message) use ($toemail,$appname) {
            $message->to($toemail)->subject('Forgot Password')->from('admin@naukriyan.com',$appname);
        });
        return 1;

    }

    public function updatepassword(Request $request)
    {
        $pass=$request->input('password');
        $access_token=$request->input('access_token');
        $user_token=md5(rand());
        $input=array();
        $input['user_token']=$user_token;
        $input['password']=Hash::make($request->input('password'));
        $chck=User::where('user_token',$access_token)->first();
        if($chck)
        {
            User::where('user_token',$access_token)->update($input);
            return 1;
        }else
        {
            return 0;
        }
    }

    public function getcompanydetails(Request $request)
    {
        $compslug=base64_decode($request->input('access_token'));
         $company=Company::where('company_slug',$compslug)->first();
        $company->otherimages=explode(',',$company->company_pics);
        return $company;
    }
    
}
