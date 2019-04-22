<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Job;
use App\Category;
use App\Country;
use App\SubCategory;
use App\Company;
use App\Questionnaire;
use App\Question;
use App\JobApplications;
use App\Venue;
use App\Interview;
use App\Advertisement;
use App\Package;
use App\Imports\UsersImport;
use Auth;
use Session;
use DB;
use View;
use Intervention\Image\Facades\Image;
class Employer extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin,web');
     /*  $adverts=Advertisement::where(array('adv_status'=>1))
                ->where('adv_image','!=','')
                ->inRandomOrder()->limit(2)->get();
               // print_r($adverts);die;
                 view()->share(array('adverts'=>$adverts));*/
    }

    public function index(){
    	//return dd("working on it!");
      $adverts=$this->getadverts(Auth::user()->id);
    	User::where('id',Auth::user()->id)->update(array('last_login'=>date('Y-m-d H:i:s')));
    	$jobs=Job::where('job_user_id',Auth::user()->id)->count();
      $jobs2=Job::where('job_user_id',Auth::user()->id)->get();
      $activejobs=Job::where(array('job_user_id'=>Auth::user()->id,'job_status'=>1))->count();
      $applicationsv=DB::table('jobs')
                      ->join('jobApplication','jobApplication.job_id','jobs.job_id')
                      ->where(array('jobs.job_user_id'=>Auth::user()->id))
                      ->where('jobApplication.applicationStatus','<>','Applied')
                      ->count();
      $applicationsI=DB::table('jobs')
                      ->join('jobApplication','jobApplication.job_id','jobs.job_id')
                      ->where(array('jobs.job_user_id'=>Auth::user()->id))
                      ->where('jobApplication.applicationStatus','Interview')
                      ->count();
        //$activejobs=$i;
      return view('Employer.dashboard',compact('jobs','adverts','applicationsv','applicationsI','activejobs'));
    }

    public function edit_employer(Request $request){
    	

    	$categories=Category::where('category_status',1)->get();
    	$result=User::where('id',Auth::user()->id)->first();
    	if($request->isMethod('post')){
    		$input=array();
    		$input['user_first_name']=$request->input('user_first_name');
    		$input['user_last_name']=$request->input('user_last_name');
    		$input['user_contact']=$request->input('user_contact');
    		$oldcontact=$request->input('oldcontact');
    		if($oldcontact!=$input['user_contact']){
    			$input['is_contact_verified']=0;
    		}
    		$input['user_dob']=$request->input('user_dob');
    		$input['user_gender']=$request->input('user_gender');
    		$input['user_id_proof']=$request->input('user_id_proof');
    		$input['user_designation']=$request->input('user_designation');
    		$input['user_industry']=$request->input('user_category');
    		$input['user_functional_area']=$request->input('user_functional_area');
    		$oldpic=$request->input('oldpic');
    		$oldthumb=$request->input('oldthumb');
    		$input['user_fb_link']=$request->input('user_facebook');
    		$input['user_twitter_link']=$request->input('user_twitter');
    		$input['user_linkedin_link']=$request->input('user_linkedin');
    		if($request->hasFile('profilepic')){
    			if(!file_exists('admin_assets/uploaded_images/profile_pic')){
	                mkdir('admin_assets/uploaded_images/profile_pic',0777,true);
	            }
	            $destinationPath =public_path('admin_assets/uploaded_images/profile_pic');
	            if(!file_exists('admin_assets/uploaded_images/profile_pic/thumb')){
	                mkdir('admin_assets/uploaded_images/profile_pic/thumb',0777,true);
	            }
	            $thumbdestinationPath =public_path('admin_assets/uploaded_images/profile_pic/thumb');
	            /****get basic info****/
	            //$s3=Storage::disk('s3');
	            $profilepic=$request->file('profilepic');
	            $extension=$request->file('profilepic')->getClientOriginalExtension();
	            $filename=uniqid().'.'.$extension;
	           /* $mimetype=$request->file('profilepic')->getClientMimeType();
	            $filesize=$request->file('profilepic')->getClientSize();*/
	            $image=Image::make($profilepic)->save($destinationPath.'/'.$filename);
	            /*****make thumb****/
	            $profileThumb=Image::make($profilepic)->fit(320)->crop(320,240,0,0)->save($thumbdestinationPath.'/'.$filename);
	            //$profileThumb->encode($extension);
	            //$profilepic->encode($extension);
	            /*****Upload the image****/
	            /*Storage::put($destinationPath.'/'.$filename,(string) $profilepic,'public');
	            Storage::put($thumbdestinationPath.'/'.$filename,(string) $profileThumb,'public');*/
	            /*******Save in db******/
	            $input['user_profile_picture']=$filename;
    			$input['user_profile_pic_thumb']=$filename;

    		}else{
    			$input['user_profile_picture']=$oldpic;
    			$input['user_profile_pic_thumb']=$oldthumb;
    		}
    		User::where('id',Auth::user()->id)->update($input);
    		/*user_profile_pic_thumb*/

    	}
    	//$subcat=
    	return view('Employer.editprofile',compact('result','categories'));
    }

    /**************Edit organization***************/
    public function edit_organization(){
        $result=DB::table('companies')
                ->select('companies.*','categories.category_name')
                ->leftjoin('categories','categories.category_id','=','companies.company_category')
                ->where('company_id',Auth::user()->user_company)->first();

        //print_r($result);die;
        if(!$result){
            return redirect()->back();
        }
        $countries=Country::all();
        $categories=Category::where('category_status',1)->get();

        return view('Employer.edit_organization',compact('result','categories','countries'));
    }

    public function update_organization(Request $request)
    {
        $input=array();
        $input['company_name']=$request->input('company_name');
        $fn=str_replace(' ', '-', $request->input('company_name'));
        $dt=strtotime(now());
        $input['company_slug']=$fn.'-'.$dt;

        $input['company_tag_line']=$request->input('company_tag_line');
        $input['company_category']=$request->input('company_category');
        $input['company_owner']=$request->input('company_owner');
        $input['company_email']=$request->input('company_email');
        $input['company_contact']=$request->input('company_contact');
        $input['company_website']=$request->input('company_website');
        $input['additionalinfo']=$request->input('additionalinfo');
        $input['number_of_employees']=$request->input('number_of_employees');
        $input['company_establish_date']=$request->input('company_establish_date');
        $input['company_address']=$request->input('company_address');
        $input['latt']=$request->input('company_lat');
        $input['longg']=$request->input('company_long');
        $input['company_country']=$request->input('company_country');
        $input['company_state']=$request->input('company_state');
        $input['company_city']=$request->input('company_city');
        $input['company_capital']=$request->input('company_capital');
        $input['company_corporate_number']=$request->input('company_corporate_number');
        $input['company_fb']=$request->input('company_fb');
        $input['company_twitter']=$request->input('company_twitter');
        $input['company_linked_in']=$request->input('company_linked_in');
        $input['company_about']=$request->input('company_about');
        $input['company_videos']=$request->input('company_videos');
        if($request->hasFile('company_logo')){
            $input['company_logo']=$this->uploadfile($request->file('company_logo'));
        }else{
            $input['company_logo']=$request->input('oldlogo');
        }
        if($request->hasFile('company_cover_image')){
            $input['company_cover_image']=$this->uploadfile($request->file('company_cover_image'));
        }else{
            $input['company_cover_image']=$request->input('oldcover');
        }
        if($request->hasFile('company_pics')){
            $input['company_pics']=$this->uploadfiles($request->file('company_pics'));
        }else{
            $input['company_pics']=$request->input('oldpics');
        }

        Company::where('company_id',Auth::user()->user_company)->update($input);
        return redirect()->back();
    }
    /**************Edit organization***************/
    /**************function for uploading single image**************/
    public function uploadfile($file){
                if(!file_exists('admin_assets/uploaded_images/company_pic')){
                    mkdir('admin_assets/uploaded_images/company_pic',0777,true);
                }
                $destinationPath =public_path('admin_assets/uploaded_images/company_pic');
                if(!file_exists('admin_assets/uploaded_images/company_pic/thumb')){
                    mkdir('admin_assets/uploaded_images/company_pic/thumb',0777,true);
                }
                $thumbdestinationPath =public_path('admin_assets/uploaded_images/company_pic/thumb');
                /****get basic info****/
                //$s3=Storage::disk('s3');
                $profilepic=$file;
                $extension=$file->getClientOriginalExtension();
                $filename=uniqid().'.'.$extension;
               /* $mimetype=$request->file('profilepic')->getClientMimeType();
                $filesize=$request->file('profilepic')->getClientSize();*/
                $image=Image::make($profilepic)->save($destinationPath.'/'.$filename);
                /*****make thumb****/
                $profileThumb=Image::make($profilepic)->fit(320)->crop(320,240,0,0)->save($thumbdestinationPath.'/'.$filename);
                return $filename;
    }
    /**************function for uploading single image**************/

    /**************function for uploading multiple image**************/
    public function uploadfiles($files){
        $filename2='';
        foreach ($files as $file) {
        if(!file_exists('admin_assets/uploaded_images/company_pic/gallery')){
                    mkdir('admin_assets/uploaded_images/company_pic/gallery',0777,true);
                }
                $destinationPath =public_path('admin_assets/uploaded_images/company_pic/gallery');
                if(!file_exists('admin_assets/uploaded_images/company_pic/thumb/gallery')){
                    mkdir('admin_assets/uploaded_images/company_pic/thumb/gallery',0777,true);
                }
                $thumbdestinationPath =public_path('admin_assets/uploaded_images/company_pic/thumb/gallery');
                /****get basic info****/
                //$s3=Storage::disk('s3');
                $profilepic=$file;
                $extension=$file->getClientOriginalExtension();
                $filename=uniqid().'.'.$extension;
               /* $mimetype=$request->file('profilepic')->getClientMimeType();
                $filesize=$request->file('profilepic')->getClientSize();*/
                $image=Image::make($profilepic)->save($destinationPath.'/'.$filename);
                /*****make thumb****/
                $profileThumb=Image::make($profilepic)->fit(320)->crop(320,240,0,0)->save($thumbdestinationPath.'/'.$filename);
                 $filename2=$filename2.','.$filename;     
        }
                return $filename2;
    }
    /**************function for uploading multiple image**************/
     /********************Post/EditJob******************************/
    public function post_new_job(Request $request)
    {
        $categories=Category::where('category_status',1)->get();
        $questionnaires=Questionnaire::where('user_id',Auth::user()->id)->get();
        return view('Employer.post_job',compact('categories','questionnaires'));
    }
        /*************Save Job***************/
    public function save_job(Request $request)
    {
       $input=array();
       extract($request->all());
       $input['job_title']=$job_title;
       $input['job_user_id']=Auth::user()->id;
       $input['job_company_id']=Auth::user()->user_company;
       $input['job_category']=$job_category;
       $input['job_sub_category']=$job_sub_category;
       $input['job_career_level']=$job_career_level;
       $input['job_role']=$job_role;
       $input['job_vacancy']=$job_vacancy;
       $input['job_experience']=$job_experience.'-'.$job_experience_max;
       $input['min_exp']=$job_experience;
       $input['max_exp']=$job_experience_max;
       $input['job_last_applying_date']=$job_last_applying_date;
       $input['job_expiry_date']=$job_last_applying_date;
       $input['job_qualification']=implode(',',$job_qualification);
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
       return redirect()->route('jobpost_success',[$jid]);
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
       $input['min_exp']=$job_experience;
       $input['max_exp']=$job_experience_max;
       $input['job_last_applying_date']=$job_last_applying_date;
       $input['job_expiry_date']=$job_last_applying_date;
       $input['job_qualification']=implode(',',$job_qualification);
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

       return redirect()->route('jobpost_success',[$job_id]);
    }
        /*************Save Job***************/
    /******************jobpost success*******/
    public function jobpost_success($jid)
    {
        if($jid!='' && $jid!=0){
            return view('Employer.job_posting_success');    
        }else
        {
            return redirect('employer/home');
        }
        
    }
    /********************Post/EditJob******************************/
    /******************Questionnaire starts from here**************/
    public function questionnaire(Request $request)
    {
        $results=Questionnaire::paginate(4);
        if($results)
        {
          foreach($results as $rec)
          {
            $rec->questions=Question::where('questionnaire_id',$rec->questionnaire_id)->count();
          }
        }
        return view('Employer.questionnaire',compact('results'));
    }
    public function add_questionnaire(Request $request)
    {
        if($request->isMethod('post')){
            $input=array();
            $quid=$request->input('questionnaire_id');
            $input['questionnaire_title']=$request->input('questionnaire_title');
            $input['submission_days']=$request->input('submission_days');
            if($request->input('accept_late_submission')!=''){
                $input['accept_late_submission']=$request->input('accept_late_submission');
            }else{
                $input['accept_late_submission']=0;
            }
            if($request->input('suffle_questions')!='')
            {
                $input['suffle_questions']=$request->input('suffle_questions');    
            }else{
                $input['suffle_questions']=0;
            }
            if($quid==0){
                $input['user_id']=Auth::user()->id;
                $input['company_id']=Auth::user()->user_company;
                Questionnaire::insert($input);
            }else
            {
                Questionnaire::where('questionnaire_id',$quid)->update($input);               
            }
            return redirect()->route('questionnaire');

        }
        $results='';
        return view('Employer.add_questionnaire',compact('results'));
    }

    public function edit_questionnaire($id)
    {
        $qid=base64_decode($id);
        $results=Questionnaire::where('questionnaire_id',$qid)->first();
        return view('Employer.add_questionnaire',compact('results'));   
    }
    /******************Questionnaire ends here*********************/
    /************************Manage Jobs**************************/
    public function manage_jobs()
    {
        return view('Employer.manage_jobs');
    }

    public function fetchjobsofuser(Request $request)
    {
        $uid=Auth::user()->id;
        if($request->has('searchjob'))
        {
          $search=$request->input('searchjob');
        }else
        {
          $search='';
        }
        $limit=$request->input('limit');
         $results=DB::table('jobs')->where('job_user_id',$uid)
                ->where(function($query) use($search){
                  if($search!=''){
                  $expl = @explode(' ', $search);
                  foreach($expl as $kw){
                        $query->orWhere('job_title','LIKE','%'.$kw.'%');
                   }
                 }
                })
                ->where(function($query) use($limit){
                  if($limit!='all')
                  {
                    if($limit=='Deactive')
                    {
                      $query->where(array('jobs.job_status'=>'3','jobs.job_status'=>'4'));
                    }
                    elseif($limit=='1')
                    {
                      $query->where('jobs.job_status','1');
                    }
                    elseif($limit=='2')
                    {
                      $query->where('jobs.job_status','2');
                    }
                    elseif($limit=='3')
                    {
                      $query->where(array('jobs.job_status'=>'3','jobs.job_status'=>'4'));
                    }

                    else
                    {
                      $query->where('jobs.job_p_category',$limit);
                    }
                  }
                })
                ->select('jobs.*','companies.company_name','companies.company_logo')
                  ->join('companies','companies.company_id','=','jobs.job_company_id')->paginate(4);

         foreach ($results as $rec) {
            $rec->encid=base64_encode($rec->job_id);
            $rec->application=JobApplications::where('job_id',$rec->job_id)->count();
            $rec->shortlist=JobApplications::where(array('job_id'=>$rec->job_id,'applicationStatus'=>'Shortlisted'))->count();
            $rec->inteview=JobApplications::where(array('job_id'=>$rec->job_id,'applicationStatus'=>'Interview'))->count();
            $rec->offer=JobApplications::where(array('job_id'=>$rec->job_id,'applicationStatus'=>'Offered'))->count();
            $rec->savedfor=JobApplications::where(array('job_id'=>$rec->job_id,'applicationStatus'=>'FutureSave'))->count();
            $rec->companylogo=url('admin_assets/uploaded_images/company_pic/thumb/'.$rec->company_logo);
            $rec->dateofexpiry=date('M d,Y',strtotime($rec->job_expiry_date));
             if($rec->job_status==0)
             {
                $sts='Pending';
             }
             if($rec->job_status==1)
             {
                $sts='Active';
             }
             if($rec->job_status==2)
             {
                $sts='Rejected';
             }
             if($rec->job_status==3)
             {
                $sts='Inactive';
             }
             $rec->status=$sts;
         }
       /*  $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'data' => $results
        ];*/
        return response()->json($results);
         //return json($results);  
    }

    public function editjob($id)
    {
        $results=Job::where('job_id',base64_decode($id))->first();
        $categories=Category::where('category_status',1)->get();
        $questionnaires=Questionnaire::where('user_id',Auth::user()->id)->get();
        return view('Employer.edit_job_post',compact('results','categories','questionnaires'));
    }

    public function change_status(Request $request)
    {
        $jid=base64_decode($request->input('jid'));
        $status=$request->input('status');
        Job::where('job_id',$jid)->update(array('job_status'=>$status));
       
         return 1;

    }
    /************************Manage Jobs**************************/
    /************************Manage Applications************************/
    public function manage_application(Request $request,$jid)
    {
      $job_id=base64_decode($jid);
      $jobdetails=Job::where('job_id',$job_id)->first();
      if($jobdetails)
      {
        return view('Employer.manage_application',compact('jobdetails'));
      }else
      {
        return redirect()->back();
      }
    }

    public function fetchapplicationsofjob(Request $request)
    {
      $type=$request->input('type');
      $jobid=base64_decode($request->input('access_token'));
      $applications=DB::table('jobApplication')
                    ->select('users.user_first_name','users.user_last_name','user_profile_picture','user_profile_pic_thumb','email','user_designation','users.user_expected_salary','user_meta.notice_period','jobApplication.*','users.user_experience_year','users.user_experience_months','users.user_slug')
                    ->join('users','users.id','jobApplication.user_id')
                    ->leftjoin('user_meta','user_meta.user_id','jobApplication.user_id')
                    ->where('jobApplication.job_id',$jobid)
                    ->where(function($query) use($type){
                      if($type!='All')
                      {
                        $query->where('applicationStatus',$type);
                      }
                    })
                    ->paginate(10);
          foreach($applications as $apps)
          {
            $apps->appliedDate=date('M d,Y',strtotime($apps->created_at));
          }
        return response()->json($applications);
    }
    /************************Manage Applications************************/

    public function updateApplicationStatus(Request  $request)
    {
      $candidates=explode(',',$request->input('appid'));
      $job_id=$request->input('job_id');
      $status=$request->input('status');

      foreach($candidates as $candidatei)
      {

        if($candidatei!=''){
          $can=explode('_',$candidatei);
          $candidate=$can[0];
         JobApplications::where(array('id'=>$candidate))->update(array('applicationStatus'=>$status));
        }
      }


      
      return 1;
    }

    public function candidate_profile($id)
    {
      $userdetails=User::where('user_slug',$id)->first();
      return view('Employer.jobseeker_profile',compact('userdetails'));
    }

    public function questions(Request $request,$id)
    {
      $questionnaire_id=base64_decode($id);
      $results=Question::where('questionnaire_id',base64_decode($id))->paginate(5);
      return view('Employer.allquestions',compact('results','questionnaire_id'));
    }

    public function addquestions(Request $request,$id,$questionid)
    {
        $questionnaire_id=base64_decode($id);
        if($questionid!='0')
        {
          $questiondetails=Question::where('id',$questionid)->first();
       //   dd($questiondetails);die;
         return view('Employer.addquestions',compact('questionnaire_id','questiondetails')); 
       }else
       {
        $questiondetails=array();
        return view('Employer.addquestions',compact('questionnaire_id','questiondetails'));
       }
        
    }

    public function addnewquestion(Request $request,$id)
    {
      $questionnaire_id=base64_decode($id);
      $input=array();
      $input['questionnaire_id']=$questionnaire_id;
      $input['question']=$request->input('questions');
      $input['marks']=$request->input('marks');
      $input['options']=implode(',',$request->input('options'));
      if($request->has('is_required'))
      {
        $input['is_required']=1;
      }
      if($request->has('is_shuffle'))
      {
        $input['is_suffle']=1;
      }
      if($request->input('questionid')=='0')
      {
        Question::insert($input);
      }else
      {
        Question::where(array('id'=>$request->input('questionid')))->update($input);
      }
      return redirect()->route('questions',[$id]);
    }

    public function deletequestions(Request $request,$id,$questionid)
    {
      Question::where(array('id'=>$questionid,'questionnaire_id'=>base64_decode($id)))->delete();
      return redirect()->back();
    }
    public function deletequestionnaire(Request $request,$id)
    {
      Question::where(array('questionnaire_id'=>base64_decode($id)))->delete();
      Questionnaire::where('questionnaire_id',base64_decode($id))->delete();
      return redirect()->back();
    }

    public function myInterview(Request $request)
    {
      if($request->has('search'))
      {
        $search=$request->input('search');
      }else
      {
        $search='';
      }
      $results=DB::table('jobApplication')
              ->select('jobApplication.*','jobs.job_title','users.user_first_name','users.user_last_name','users.email','interviews.interview_time','interviews.interview_date')
              ->join('jobs','jobs.job_id','jobApplication.job_id')
              ->join('users','users.id','jobApplication.user_id')
              ->join('interviews','interviews.job_id','jobApplication.job_id')
              ->where(function($query) use($search){
                if($search!='')
                {
                  $expl = @explode(' ', $search);
                foreach($expl as $kw){
                        $query->orWhere('jobs.job_title','LIKE','%'.$kw.'%');
                        $query->orWhere('users.user_first_name','LIKE','%'.$kw.'%');
                        $query->orWhere('users.user_last_name','LIKE','%'.$kw.'%');
                        $query->orWhere('users.email','LIKE','%'.$kw.'%');
                   }
                }
              })
              ->where(array('jobs.job_user_id'=>Auth::user()->id,'applicationStatus'=>'Interview'))
              ->paginate(5);
      return view('Employer.myInterview',compact('results','search'));
    }

    public function cancelInterview($applicationid)
    {
      JobApplications::where('id',base64_decode($applicationid))->update(array('applicationStatus'=>'Pending'));
      return back()->with('success','Interview Canceled Successfully!');
     // Session::flash('Interview Cnaceled Successfully', 'success');
      //return redirect()->back();
      /*->withSuccess('Interview Cnaceled Successfully')*/
    }

    public function venues(Request $request)
    {
      $search='';
      if($request->has('search'))
      {
        $search=$request->input('search');
      }

      $venues=Venue::where('user_id',Auth::user()->id)
              ->where(function($query) use($search){
                if($search!='')
                {
                  $query->where('venue_name','LIKE','%'.$search.'%');
                }
              })
              ->paginate(10);
      return view('Employer.venue_listing',compact('venues','search'));
    }
    public function add_venues()
    {
      $venue=array();
      return view('Employer.add_interview_venue',compact('venue'));
    }
    public function edit_venue($id)
    {
      $venue=Venue::where('venue_id',base64_decode($id))->first();
      return view('Employer.add_interview_venue',compact('venue'));
    }
    public function save_venues(Request $request)
    {
      $input=array();
      $input['venue_name']=$request->input('venue_name');
      $input['venue_address']=$request->input('venue_address');
      $input['contact_person']=$request->input('contact_person');
      $input['contact_email']=$request->input('contact_email');
      $input['contact_no']=$request->input('contact_no');
      $input['instructions']=$request->input('instruction');
      $input['user_id']=$uid=Auth::user()->id;
      if($request->input('venue_id')=='0')
      {
        Venue::insert($input);
      }else
      {
        Venue::where('venue_id',$request->input('venue_id'))->update($input);
      }
      return redirect()->route('venues');
    }

    public function change_status_of_venue($id,$status)
    {
      Venue::where('venue_id',base64_decode($id))->update(array('venue_status'=>!$status));
      return redirect()->back();
    }

    public function fetchvenuelist()
    {
      return $venues=Venue::where(array('user_id'=>Auth::user()->id,'venue_status'=>1))->get();
    }

    public function scheduleInterview(Request $request)
    {
      $input=array();
      $jobid=base64_decode($request->input('jobid'));
      $input['job_id']=$jobid;
      $input['venue_id']=$request->input('venueName');
      $input['contact_person']=$request->input('contactPerson');
      $input['contact_email']=$request->input('contactEmail');
      $input['contact_no']=$request->input('contactNo');
      $input['interview_time']=$request->input('interviewTime');
      $input['interview_date']=$request->input('interviewDate');
      $input['instruction']=$request->input('instruction');
       $candidates=explode(',',$request->input('candidates'));
      foreach($candidates as $candidatei)
      {

        if($candidatei!=''){
          $can=explode('_',$candidatei);
          $candidate=$can[0];
          $appdet=JobApplications::where(array('id'=>$candidate,'job_id'=>$jobid))->first();
          $chck=Interview::where(array('job_id'=>$jobid,'user_id'=>$appdet->user_id))->first();
          if(!$chck)
          {
            $input['user_id']=$candidate;
            JobApplications::where(array('job_id'=>$jobid,'id'=>$candidate))->update(array('applicationStatus'=>'Interview'));
            Interview::insert($input);
          }else
          {
            $input['application_status']=1;
            JobApplications::where(array('job_id'=>$jobid,'id'=>$candidate))->update(array('applicationStatus'=>'Interview'));
            Interview::where('interview_id',$chck->interview_id)->update($input);
          }
        }
      }
      return 1;
    } 

    public function sendMessage(Request $request)
    {
      $candidates=explode(',',$request->input('candidates'));
      $job_id=$request->input('job_id');
      $message=$request->input('message');

      foreach($candidates as $candidatei)
      {

        if($candidatei!=''){
          $can=explode('_',$candidatei);
          $candidate=$can[0];
         JobApplications::where(array('id'=>$candidate))->update(array('comments'=>$message));
        }
      }


      
      return 1; 
    }
    public function getadverts($id)
    {
        $adverts=array();
        $userd=User::where('id',$id)->first();
        if($userd)
        {
            $catid=$userd->user_industry;
            return $adverts=Advertisement::where(function($query){
                $query->where('adv_for','Employer');
                $query->orWhere('adv_for','all');
            })
            ->where(function($query) use($catid){
              if($catid!=''){
                $query->where('adv_category','LIKE','%Adv_'.$catid.'_cat%');
              }
            })->where(array('adv_status'=>1))
                ->where('adv_image','!=','')
                ->inRandomOrder()->limit(2)->get();
        }
        return $adverts;

    }

    public function packages()
    {
      $packages=Package::where(array('package_status'=>1,'package_for'=>'Employer'))->get();
      return view('Employer.packages',compact('packages'));
    }


    public function payments(){
      echo 1;
    }



}
