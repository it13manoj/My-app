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
use App\Meta;
use App\Resume;
use App\SavedJobs;
use App\JobApplications;
use App\Question;
use Auth;
use DB;
use App\Advertisement;
use Intervention\Image\Facades\Image;

class Jobseeker extends Controller
{
    public function __construct()
    {
      // $this->middleware('auth');
    }
    public function getjobseekerdetails(Request $request)
    {
    	$token=base64_decode($request->input('access_token'));
        $userd=DB::table('users')
                ->select('users.*','user_meta.user_nationality','user_meta.notice_period','user_meta.workauth','user_meta.job_type')
                ->leftjoin('user_meta','user_meta.user_id','=','users.id')
                ->where('user_token',$token)->first();
        /*foreach($userd as $key=>$val)
        {
            return $val;
            if($val=NULL || $val==null)
               $val=''; 
        }*/
    	return json_encode($userd);
    }

    public function updatePersonalinfo(Request $request)
    {
        $input=array();
        $input2=array();
        if($request->has('userimage'))
        {
            $path=public_path('admin_assets/uploaded_images/profile_pic');
            $input['user_profile_picture']=$this->uploadfile($request->file('userimage'),$path);
        }else
        {
            $input['user_profile_picture']=$request->input('user_profile_picture');
        }
        $scon=$request->input('user_salary_confidential');
        //return $scon;
        if($scon==true)
        {
         $scon=1; 
        }
        else
        {
         $scon=0; 
        }
        $snego=$request->input('user_salary_negotiable');
         if($snego==true)
        {
         $snego=1; 
        }
        else
        {
         $snego=0; 
        }
        $input['user_first_name']=$request->input('user_first_name');
        $input['user_last_name']=$request->input('user_last_name');
        $input['email']=$request->input('email');
        $input['user_contact']=$request->input('user_contact');
        $input['user_dob']=$request->input('user_dob');
        $input['user_gender']=$request->input('user_gender');
        $input2['workauth']=$request->input('workauth');
        $input2['user_nationality']=$request->input('nationality');
        $input2['notice_period']=$request->input('notice_period');
        $input['user_id_proof']=$request->input('user_id_proof');
        $input['user_designation']=$request->input('user_designation');
        $input['user_industry']=$request->input('user_industry');
        $input['user_functional_area']=$request->input('user_functional_area');
        $input['user_experience_year']=$request->input('user_experience_year');
        $input['user_experience_months']=$request->input('user_experience_months');
        $input2['job_type']=$request->input('job_type');
        $input['user_current_salary']=$request->input('user_current_salary');
        $input['user_expected_salary']=$request->input('user_expected_salary');
        $input['user_current_location']=$request->input('user_current_location');
        $input['user_prefered_location']=$request->input('user_prefered_location');
        $input['user_salary_confidential']=$scon;
        $input['user_salary_negotiable']=$snego;
        $input['user_fb_link']=$request->input('user_fb_link');
        $input['user_twitter_link']=$request->input('user_twitter_link');
        $input['user_linkedin_link']=$request->input('user_linkedin_link');
        $uid=$request->input('id');
        User::where('id',$uid)->update($input);
        $chck=Meta::where('user_id',$uid)->first();
        if($chck)
        {
            Meta::where('user_id',$uid)->update($input2);
        }else
        {
            $input2['user_id']=$uid;
            Meta::insert($input2);
        }
    }

    /**************function for uploading single image**************/
    public function uploadfile($file,$path){
                if(!file_exists($path)){
                    mkdir($path,0777,true);
                }
                $destinationPath =$path;
                if(!file_exists($path.'/thumb')){
                    mkdir($path.'/thumb',0777,true);
                }
                $thumbdestinationPath =$path.'/thumb';
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
    /**************fetch country**************/
    public function getcountrieslist()
    {
        $country=Country::select('country_id','country_name')->where('country_status',1)->get();
        return json_encode($country);
    }
    /**************fetch country**************/
    /**************fetch industry list**************/
    public function getindustrylist()
    {
        $category=Category::select('category_id','category_name','featured')->where('category_status',1)->get();
        return json_encode($category);
    }
    /**************fetch industry list**************/
    /**************fetch functional areas list**************/
    public function getfunctionalarealist(Request $request)
    {
        $industry=$request->input('industry');
        $subcat=SubCategory::where(array('category_id'=>$industry,'subcategory_status'=>1))->get();
        return json_encode($subcat);
    }
    /**************fetch functional areas list**************/
   /**************add edcational info**************/
   public function addneweducation(Request $request)
    {
        $newedu=$request->input('newedu');
        $newper=$request->input('newper');
        $newinst=$request->input('newinst');
        $newpoy=$request->input('newpoy');
        $input=array();
        $input2=array();
        $input['user_id']=$request->input('userid');
        $input['type']='Education';
        $input2['education']=$newedu;
        if($newedu=='10th' || $newedu=='12th')
        {
            $newboard=$request->input('newboard');
            $input2['board']=$newboard;    
        }else
        {
            $newdegree=$request->input('newdegree');
            $input2['degree']=$newdegree;
        }
        $input2['percentage']=$newper;
        $input2['institute']=$newinst;
        $input2['passing_out_year']=$newpoy;
        $input['resumeData']=json_encode($input2);
        $d=Resume::insertGetId($input);
        $input2['resumeId']=$d;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
        
    }
    /**************add edcational info**************/
   /************** update edcational info**************/
    public function updateEducationalInfo(Request $request)
    {
        $newedu=$request->input('newedu');
        $newper=$request->input('newper');
        $newinst=$request->input('newinst');
        $newpoy=$request->input('newpoy');
        $resumeId=$request->input('resumeId');
        $input=array();
        $input2=array();
        //$input['user_id']=$request->input('userid');
        $input['type']='Education';
        $input2['education']=$newedu;
        if($newedu=='10th' || $newedu=='12th')
        {
            $newboard=$request->input('newboard');
            $input2['board']=$newboard;    
        }else
        {
            $newdegree=$request->input('newdegree');
            $input2['degree']=$newdegree;
        }

        $input2['percentage']=$newper;
        $input2['institute']=$newinst;
        $input2['passing_out_year']=$newpoy;
        $input['resumeData']=json_encode($input2);
        $d=Resume::where('id',$resumeId)->update($input);
        $input2['resumeId']=$resumeId;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
        
    }
    /**************update edcational info**************/
    /**************fetch educational info**************/
    public function geteducationdetails(Request $request)
    {
        $access_token=base64_decode($request->input('access_token'));
        $education=Resume::where(array('type'=>'Education','user_id'=>$access_token))->get();
        $returnarray=array();
        if($education)
        {
            foreach($education as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['education']=$resume->education;
                if($resume->education=='10th' || $resume->education=='12th')
                {
                    $input2['board']=$resume->board;    
                }else
                {
                    $input2['degree']=$resume->degree;    
                }
                $input2['percentage']=$resume->percentage;
                $input2['institute']=$resume->institute;
                $input2['passing_out_year']=$resume->passing_out_year;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray;
    }
    /**************fetch educational info**************/
    /**************remove educational info**************/
    public function removeEducationalInfo(Request $request)
    {
        $resumeId=$request->input('resumeId');
        $userId=$request->input('userId');
        Resume::where('id',$resumeId)->delete();
        $education=Resume::where(array('type'=>'Education','user_id'=>$userId))->get();
        $returnarray=array();
        if($education)
        {
            foreach($education as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['education']=$resume->education;
                $input2['board']=$resume->board;
                $input2['degree']=$resume->degree;
                $input2['percentage']=$resume->percentage;
                $input2['institute']=$resume->institute;
                $input2['passing_out_year']=$resume->passing_out_year;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray;
    
    }
    /**************remove educational info**************/
    /****************Add professional details**********/
    public function add_professional_details(Request $request)
    {
        $designation=$request->input('designation');
        $organization=$request->input('organization');
        $jobtype=$request->input('jobtype');
        $jobshift=$request->input('jobshift');
        $industry=$request->input('industry');
        $fArea=$request->input('fArea');
        $currentlyWork=$request->input('currentlyWork');
        if($currentlyWork==true)
        {
         $currentlyWork=true; 
        }
        else
        {
         $currentlyWork=false; 
        }

        $roleandresp=$request->input('roleandresp');
        $endDate=$request->input('endDate');
        $startDate=$request->input('startDate');
        $input=array();
        $input2=array();
        $input['user_id']=$request->input('userid');
        $input['type']='Professional';
        $input2['designation']=$designation;
        $input2['organization']=$organization;
        $input2['jobtype']=$jobtype;
        $input2['jobshift']=$jobshift;
        $input2['industry']=$industry;
        $input2['fArea']=$fArea;
        $input2['roleandresp']=$roleandresp;
        $input2['startDate']=$startDate;
        $input2['currentlyWork']=$currentlyWork;
        if(!$currentlyWork)
        {
            $input2['endDate']=$endDate;
        }
        $input['resumeData']=json_encode($input2);
        $d=Resume::insertGetId($input);
         $subcat=SubCategory::where(array('category_id'=>$industry,'subcategory_status'=>1))->get();
                $input2['subcatlist']=$subcat;
        $input2['resumeId']=$d;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
    }
    /****************Add professional details***************/

    public function getprofessionaldetails(Request $request)
    {

        $access_token=base64_decode($request->input('access_token'));
        $education=Resume::where(array('type'=>'Professional','user_id'=>$access_token))->get();
        $returnarray=array();
        if($education)
        {
            foreach($education as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['designation']=$resume->designation;
                $input2['organization']=$resume->organization;
                $input2['jobtype']=$resume->jobtype;
                $input2['jobshift']=$resume->jobshift;
                $input2['industry']=$resume->industry;
                $input2['fArea']=$resume->fArea;
                $input2['roleandresp']=$resume->roleandresp;
                $input2['startDate']=$resume->startDate;
                $input2['currentlyWork']=$resume->currentlyWork;
                if($resume->currentlyWork==false)
                {
                    $input2['endDate']=$resume->endDate;    
                }
                $subcat=SubCategory::where(array('category_id'=>$resume->industry,'subcategory_status'=>1))->get();
                $input2['subcatlist']=$subcat;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray;
    }
    /****************Get professional details***************/
    /****************Update professional details**********/
    public function update_professional_details(Request $request)
    {
        $input=array();
        $input2=array();
        $designation=$request->input('designation');
        $organization=$request->input('organization');
        $jobtype=$request->input('jobtype');
        $jobshift=$request->input('jobshift');
        $industry=$request->input('industry');
        $fArea=$request->input('fArea');
        $currentlyWork=$request->input('currentlyWork');
        $resumeId=$request->input('resumeId');
        if($currentlyWork=='yes')
        {
         $currentlyWork=true; 
        }
        else
        {
         $currentlyWork=false; 
        }

        $roleandresp=$request->input('roleandresp');
        $endDate=$request->input('endDate');
        $startDate=$request->input('startDate');
       
        $input2['designation']=$designation;
        $input2['organization']=$organization;
        $input2['jobtype']=$jobtype;
        $input2['jobshift']=$jobshift;
        $input2['industry']=$industry;
        $input2['fArea']=$fArea;
        $input2['roleandresp']=$roleandresp;
        $input2['startDate']=$startDate;
        $input2['currentlyWork']=$currentlyWork;
        if(!$currentlyWork)
        {
            $input2['endDate']=$endDate;
        }
        $input['resumeData']=json_encode($input2);
        $d=Resume::where('id',$resumeId)->update($input);
         $subcat=SubCategory::where(array('category_id'=>$industry,'subcategory_status'=>1))->get();
                $input2['subcatlist']=$subcat;
        $input2['resumeId']=$resumeId;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
    }
    /****************Update professional details***************/
    /***************Remove professional details****************/
    public function removeProfessionalInfo(Request $request)
    {
        $resumeId=$request->input('resumeId');
        $userId=$request->input('userId');
        Resume::where('id',$resumeId)->delete();
        $professional=Resume::where(array('type'=>'Professional','user_id'=>$userId))->get();
        $returnarray=array();
        if($professional)
        {
            foreach($professional as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['designation']=$resume->designation;
                $input2['organization']=$resume->organization;
                $input2['jobtype']=$resume->jobtype;
                $input2['jobshift']=$resume->jobshift;
                $input2['industry']=$resume->industry;
                $input2['fArea']=$resume->fArea;
                $input2['roleandresp']=$resume->roleandresp;
                $input2['startDate']=$resume->startDate;
                $input2['currentlyWork']=$resume->currentlyWork;
                if($resume->currentlyWork==false)
                {
                    $input2['endDate']=$resume->endDate;    
                }
                $subcat=SubCategory::where(array('category_id'=>$resume->industry,'subcategory_status'=>1))->get();
                $input2['subcatlist']=$subcat;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray;
    }
    /***************Remove professional details****************/
     /**************add edcational info**************/
   public function add_certification_details(Request $request)
    {
        $course=$request->input('course');
        $institute=$request->input('institute');
        $startDate=$request->input('startDate');
        $endDate=$request->input('endDate');
        $validTill=$request->input('validTill');
        $willExpire=$request->input('willExpire');
        $score=$request->input('score');
        $certificationType=$request->input('certificationType');
        $description=$request->input('description');
        
        if($willExpire==true)
        {
         $willExpire=true; 
        }
        else
        {
         $willExpire=false; 
        }

        $input=array();
        $input2=array();
        $input['user_id']=$request->input('userid');
        $input['type']='Certification';
        $input2['course']=$course;
        $input2['institute']=$institute;
        $input2['startDate']=$startDate;
        $input2['endDate']=$endDate;
        $input2['willExpire']=$willExpire;
        $input2['validTill']=$validTill;
        $input2['score']=$score;
        $input2['certificationType']=$certificationType;
        $input2['description']=$description;
        $input['resumeData']=json_encode($input2);
        $d=Resume::insertGetId($input);
        $input2['resumeId']=$d;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
        
    }
    /**************add edcational info**************/
    public function getcertificationdetails(Request $request)
    {
        $access_token=base64_decode($request->input('access_token'));
        $certification=Resume::where(array('type'=>'Certification','user_id'=>$access_token))->get();
        $returnarray=array();
        if($certification)
        {
            foreach($certification as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['course']=$resume->course;
                $input2['institute']=$resume->institute;
                $input2['startDate']=$resume->startDate;
                $input2['endDate']=$resume->endDate;
                $input2['willExpire']=$resume->willExpire;
                $input2['validTill']=$resume->validTill;
                $input2['score']=$resume->score;
                $input2['certificationType']=$resume->certificationType;
                $input2['description']=$resume->description;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray; 
    }
     /**************add edcational info**************/
   public function update_certification_details(Request $request)
    {
        $course=$request->input('course');
        $institute=$request->input('institute');
        $startDate=$request->input('startDate');
        $endDate=$request->input('endDate');
        $validTill=$request->input('validTill');
        $willExpire=$request->input('willExpire');
        $score=$request->input('score');
        $certificationType=$request->input('certificationType');
        $description=$request->input('description');
        $resumeId=$request->input('resumeId');
        
        if($willExpire==true)
        {
         $willExpire=true; 
        }
        else
        {
         $willExpire=false; 
        }

        $input=array();
        $input2=array();
        $input2['course']=$course;
        $input2['institute']=$institute;
        $input2['startDate']=$startDate;
        $input2['endDate']=$endDate;
        $input2['willExpire']=$willExpire;
        $input2['validTill']=$validTill;
        $input2['score']=$score;
        $input2['certificationType']=$certificationType;
        $input2['description']=$description;
        $input['resumeData']=json_encode($input2);
        $d=Resume::where('id',$resumeId)->update($input);
        $input2['resumeId']=$resumeId;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
        
    }

    public function removeCertificationInfo(Request $request)
    {
        $resumeId=$request->input('resumeId');
        $userId=$request->input('userId');
        Resume::where('id',$resumeId)->delete();
        $certification=Resume::where(array('type'=>'Certification','user_id'=>$userId))->get();
        $returnarray=array();
        if($certification)
        {
            foreach($certification as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2=array();
                $input2['course']=$course;
                $input2['institute']=$institute;
                $input2['startDate']=$startDate;
                $input2['endDate']=$endDate;
                $input2['willExpire']=$willExpire;
                $input2['validTill']=$validTill;
                $input2['score']=$score;
                $input2['certificationType']=$certificationType;
                $input2['description']=$description;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray;
    }
    /**************add edcational info**************/






public function add_skill_details(Request $request)
    {
        $skill=$request->input('skill');
        $expertise=$request->input('expertise');
        $resumeId=$request->input('resumeId');

        $input=array();
        $input2=array();
        $input2['skill']=$skill;
        $input2['expertise']=$expertise;
        $input['resumeData']=json_encode($input2);
        if($resumeId==0)
        {
            $input['user_id']=$request->input('userid');
            $input['type']='Skills';
            $d=Resume::insertGetId($input);
        }
        else
        {
            Resume::where('id',$resumeId)->update($input);
            $d=$resumeId;
        }
        
        $input2['resumeId']=$d;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
        
    }
    /**************add edcational info**************/
    public function getskilldetails(Request $request)
    {
        $access_token=base64_decode($request->input('access_token'));
        $certification=Resume::where(array('type'=>'Skills','user_id'=>$access_token))->get();
        $returnarray=array();
        if($certification)
        {
            foreach($certification as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['skill']=$resume->skill;
                $input2['expertise']=$resume->expertise;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray; 
    }
     /**************add skill info**************/
  
  public function removeskillInfo(Request $request)
    {
        $resumeId=$request->input('resumeId');
        $userId=$request->input('userId');
        Resume::where('id',$resumeId)->delete();
        $certification=Resume::where(array('type'=>'Skills','user_id'=>$userId))->get();
        $returnarray=array();
        if($certification)
        {
            foreach($certification as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['skill']=$resume->skill;
                $input2['expertise']=$resume->expertise;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return $returnarray;
    }

    public function add_resume(Request $request)
    {
        $cover_letter=$request->input('cover_letter');
        $resumeId=$request->input('resumeId');
        $resume_link=$request->input('resume_link');
        $input=array();
        $input2=array();
        $input2['cover_letter']=$cover_letter;
        $input2['resume_link']=$resume_link;
         if($request->hasFile('resume')){
            $resume=$request->file('resume');
            if(!file_exists(public_path('admin_assets/resume'))){
                mkdir(public_path('admin_assets/resume'),0777,true);
            }
            $destinationPath =public_path('admin_assets/resume');
            $filename        = str_random(6) . '.' . $resume->getClientOriginalExtension();
            $uploadSuccess   = $resume->move($destinationPath, $filename);
            $input2['resume']=$filename;
        }else
        {
            $input2['resume']=$request->input('old_resume');
        }
        if($request->hasFile('video_resume')){
            $video_resume=$request->file('video_resume');
            if(!file_exists(public_path('admin_assets/resume'))){
                mkdir(public_path('admin_assets/resume'),0777,true);
            }
            $destinationPath =public_path('admin_assets/resume');
            $filename2        = str_random(6) . '.' . $video_resume->getClientOriginalExtension();
            $uploadSuccess   = $video_resume->move($destinationPath, $filename);
            $input2['video_resume']=$filename2;
        }
        else
        {
            $input2['video_resume']=$request->input('old_video_resume');
        }

        if($resumeId==0)
        {
            $input['user_id']=$request->input('userid');
            $input['resumeData']=json_encode($input2);
            $input['type']='Resume';
            $d=Resume::insertGetId($input);
        }
        else
        {
            $input['resumeData']=json_encode($input2);
            Resume::where('id',$resumeId)->update($input);
            $d=$resumeId;
        }
        
        $input2['resumeId']=$d;
        $input2['userId']=$request->input('userid');
        return json_encode($input2);
    }

    public function fetchresumedetails(Request $request)
    {
        $access_token=base64_decode($request->input('access_token'));
        $resume=Resume::where(array('type'=>'Resume','user_id'=>$access_token))->get();
        $returnarray=array();
        if($resume)
        {
            foreach($resume as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['resume']=$resume->resume;
                $input2['cover_letter']=$resume->cover_letter;
                $input2['resume_link']=$resume->resume_link;
                $input2['video_resume']=$resume->video_resume;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($returnarray,$input2);
            }
        }
        return json_encode($returnarray); 
    }

    public function getUsersResumeDetails(Request $request)
    {
       
        $data=array();
        if($request->has('access_token')){
        $userid=base64_decode($request->input('access_token'));
        $userDetails=DB::table('users')
                            ->select('users.*','categories.category_name','subcategories.subcategory_name')
                            ->leftjoin('categories','categories.category_id','users.user_industry')
                            ->leftjoin('subcategories','subcategories.subcategory_id','users.user_functional_area')
                            ->where('id',$userid)->first();
        $data['userDetails']=$userDetails; 
        $uid=$userDetails->id;
        }
        if($request->has('profile_slug'))
        {
        $userid=base64_decode($request->input('profile_slug'));
        $userDetails=DB::table('users')
                            ->select('users.*','categories.category_name','subcategories.subcategory_name')
                            ->leftjoin('categories','categories.category_id','users.user_industry')
                            ->leftjoin('subcategories','subcategories.subcategory_id','users.user_functional_area')
                            ->where('users.user_slug',$userid)->first(); 
        $data['userDetails']=$userDetails; 
        $uid=$userDetails->id;
        }
        $data['usermeta']=Meta::where('user_id',$uid)->first();
        /***********Education Details**********/
        $education=Resume::where(array('user_id'=>$uid,'type'=>'Education'))->get();
        $educationarray=array();
        if($education)
        {
            foreach($education as $key=>$val)
            {
                $eduinput2=array();
                $resume=json_decode($val->resumeData);
                $eduinput2['education']=$resume->education;
                if($resume->education=='10th' || $resume->education=='12th')
                {
                $eduinput2['board']=$resume->board;
                }else{
                $eduinput2['degree']=$resume->degree;
                }
                $eduinput2['percentage']=$resume->percentage;
                $eduinput2['institute']=$resume->institute;
                $eduinput2['passing_out_year']=$resume->passing_out_year;
                $eduinput2['resumeId']=$val->id;
                $eduinput2['userId']=$val->user_id;
                array_push($educationarray,$eduinput2);
            }
        }
        $data['resumeEducation']=$educationarray;
        /***********Education Details**********/
        /***********Professional Details****************/
       $prefession =Resume::where(array('user_id'=>$uid,'type'=>'Professional'))->get();
         $resumeProfession=array();
        if($prefession)
        {
            foreach($prefession as $key=>$val)
            {
                $inputprpfession=array();
                $resume=json_decode($val->resumeData);
                $inputprpfession['designation']=$resume->designation;
                $inputprpfession['organization']=$resume->organization;
                $inputprpfession['roleandresp']=$resume->roleandresp;
                $inputprpfession['startDate']=$resume->startDate;
                $inputprpfession['currentlyWork']=$resume->currentlyWork;
                if($resume->currentlyWork==false)
                {
                    $inputprpfession['endDate']=$resume->endDate;    
                }
                $inputprpfession['resumeId']=$val->id;
                $inputprpfession['userId']=$val->user_id;
                array_push($resumeProfession,$inputprpfession);
            }
        }
        $data['resumeProfession']=$resumeProfession;
        /***********Professional Details****************/
        /**********Certification Details***************/
      $certification =Resume::where(array('user_id'=>$uid,'type'=>'Certification'))->get();
         $certarray=array();
         if($certification)
        {
            foreach($certification as $key=>$val)
            {
                $inputcert=array();
                $resume=json_decode($val->resumeData);
                $inputcert['course']=$resume->course;
                $inputcert['institute']=$resume->institute;
                $inputcert['startDate']=$resume->startDate;
                $inputcert['endDate']=$resume->endDate;
                //$inputcert['willExpire']=$resume->willExpire;
               /* $inputcert['validTill']=$resume->validTill;
                $inputcert['score']=$resume->score;
                $inputcert['certificationType']=$resume->certificationType;*/
                $inputcert['description']=$resume->description;
                $inputcert['resumeId']=$val->id;
                $inputcert['userId']=$val->user_id;
                array_push($certarray,$inputcert);
            }
        }
         $data['resumeCertification']=$certarray;
        /**********Certification Details***************/
        /***************Skill Details***********/
      $skills =Resume::where(array('user_id'=>$uid,'type'=>'Skills'))->get();
       $skillarray=array();
        if($skills)
        {
            foreach($skills as $key=>$val)
            {
                $skillinput=array();
                $resume=json_decode($val->resumeData);
                $skillinput['skill']=$resume->skill;
                $skillinput['expertise']=$resume->expertise;
                $skillinput['resumeId']=$val->id;
                $skillinput['userId']=$val->user_id;
                array_push($skillarray,$skillinput);
            }
        }
         $data['resumeSkills']=$skillarray;
        /***************Skill Details***********/
        /*******Resume details******/
        $resumes=Resume::where(array('user_id'=>$uid,'type'=>'Resume'))->get();
        $resumeResume=array();
        if($resumes)
        {
            foreach($resumes as $key=>$val)
            {
                $input2=array();
                $resume=json_decode($val->resumeData);
                $input2['resume']=$resume->resume;
                $input2['cover_letter']=$resume->cover_letter;
                $input2['resume_link']=$resume->resume_link;
                $input2['video_resume']=$resume->video_resume;
                $input2['resumeId']=$val->id;
                $input2['userId']=$val->user_id;
                array_push($resumeResume,$input2);
            }
        }
        $data['resumeResume']= $resumeResume;
        if($request->has('appid'))
        {
            $data['appdetails']=JobApplications::where('id',$request->input('appid'))->first();
        }
        /*******Resume details******/ 
        return json_encode($data);
    }

    public function getjobs(Request $request)
    {
        $industry= $request->input('industryfilter');
        $jobsearchkeyword= $request->input('jobsearchkeyword');
        $OfferedSalary=$request->input('OfferedSalary');
        $limit=$request->input('limit');
        $jobexp=$request->input('jobexp');
        $jobType=$request->input('jobType');
        $headsearch=$request->input('headsearch');
        $jobQual=$request->input('jobQual');
        $locationsearch=$request->input('locationsearch');
        $userid=base64_decode($request->input('access_token'));
         $jobs=DB::table('jobs')
                ->select('companies.company_name','companies.company_slug','companies.company_logo','jobs.*','categories.category_name')
                ->join('companies','companies.company_id','jobs.job_company_id')
                ->join('categories','categories.category_id','jobs.job_category')
                ->where(function($query) use($jobType){
                    $jobType=explode(',',$jobType);
                    if(sizeof($jobType)>0){
                        foreach($jobType as $jtype)
                        {
                            if($jtype!='')
                            {
                                $query->orwhere('jobs.job_type',$jtype);
                            }
                        }
                    }
                })
                ->where(function($query) use ($industry){
                    $industry=explode(',', $industry);
                    if(sizeof($industry)>0)
                    {
                        foreach($industry as $indus)
                        {
                            if($indus!=''){
                                $query->orwhere('jobs.job_category',$indus);
                            }
                        }
                    }
                })
                ->where(function($query) use ($jobexp){
                    $jobexp=explode(',', $jobexp);
                    if(sizeof($jobexp)>0)
                    {
                        foreach($jobexp as $exps)
                        {
                            if($exps!=''){
                                $expss=explode('-',$exps);

                                //$query->orwhere('jobs.job_category',$indus);
                                $query->orwhere([
                                    ['max_exp','>=',$expss[0]],
                                    ['min_exp','<=',$expss[0]],
                                ]);
                                
                            }
                        }
                    }
                })
                ->where(function($query) use ($jobQual){
                    if($jobQual!='')
                    {
                        $qual=explode(',', $jobQual);
                        //$query->where('jobs.job_qualification',$jobQual);
                        foreach($qual as $quali){
                            $query->orWhere('jobs.job_qualification','LIKE','%'.$quali.'%');
                        }
                    }
                })
                ->where(function($query) use($jobsearchkeyword){
                    $keyword=explode(' ', $jobsearchkeyword);
                    foreach($keyword as $kw)
                    {
                        if($kw!='')
                        {
                            $query->orWhere('jobs.job_keywords','LIKE','%'.$kw.'%');
                        }
                    }
                })
                ->where(function($query) use($headsearch){
                    $keywordh=explode(' ', $headsearch);
                    foreach($keywordh as $kw)
                    {
                        if($kw!='')
                        {
                            $query->orWhere('jobs.job_title','LIKE','%'.$kw.'%');
                            $query->orWhere('jobs.job_description','LIKE','%'.$kw.'%');
                            $query->orWhere('jobs.job_qualification','LIKE','%'.$kw.'%');
                            $query->orWhere('jobs.job_skills','LIKE','%'.$kw.'%');
                            $query->orWhere('jobs.job_benefits','LIKE','%'.$kw.'%');
                            $query->orWhere('jobs.job_keywords','LIKE','%'.$kw.'%');
                            $query->orWhere('jobs.job_address','LIKE','%'.$kw.'%');
                        }
                    }
                })
                ->where(function($query) use($locationsearch){
                    $keywordl=explode(' ', $locationsearch);
                    foreach($keywordl as $kw)
                    {
                        if($kw!='')
                        {
                            $query->where('jobs.job_address','LIKE','%'.$kw.'%');
                        }
                    }
                })
                ->where(function($query) use($OfferedSalary){
                    $OfferedSalary=explode(',', $OfferedSalary);
                    if(sizeof($OfferedSalary)>0)
                    {
                        foreach($OfferedSalary as $salry)
                        {
                            if($salry!='')
                            {
                                $newsal=explode('-',$salry);
                                $query->orwhereBetween('jobs.job_offered_salary_max', array($newsal[0], $newsal[1]));
                            }
                        }
                    }
                })
                ->where(array('job_status'=>1))->paginate($limit);
         foreach($jobs as $sjobs)
         {
            $sjobs->encId=base64_encode($sjobs->job_id);
            $similarsaved=SavedJobs::where(array('user_id'=>$userid,'job_id'=>$sjobs->job_id))->count();
                if($similarsaved>0)
                {
                    $sjobs->isSaved=1;
                }else
                {
                    $sjobs->isSaved=0;
                }
                $similarapplied=JobApplications::where(array('user_id'=>$userid,'job_id'=>$sjobs->job_id))->count();
                if($similarapplied>0)
                {
                    $sjobs->isApplied=1;
                }else
                {
                    $sjobs->isApplied=0;
                }

            $sjobs->keyws=explode(',',$sjobs->job_keywords);
         }
           return   response()->json($jobs);
    }

    public function getjobdetail(Request $request)
    {
        $jobid=base64_decode($request->input('job'));
        $userid=base64_decode($request->input('access_token'));
         $jobDetails=DB::table('jobs')
                    ->select('jobs.*','companies.company_name','companies.company_slug','companies.company_cover_image','companies.company_address','companies.company_lat','companies.company_long','companies.company_logo','categories.category_name','subcategories.subcategory_name','users.user_first_name','users.user_last_name','users.user_profile_picture','users.user_designation','users.user_contact','users.email')
                    ->leftjoin('companies','companies.company_id','=','jobs.job_company_id')
                    ->leftjoin('users','users.id','=','jobs.job_user_id')
                    ->leftjoin('categories','categories.category_id','=','jobs.job_category')
                    ->leftjoin('subcategories','subcategories.subcategory_id','=','jobs.job_sub_category')
                    ->where('jobs.job_id',$jobid)
                    ->get();
            $date1=strtotime($jobDetails[0]->created_at);
            $date22=date('Y-m-d h:i:s');
            $date2=strtotime($date22);
            $diff = abs($date2 - $date1);  
            $years = floor($diff / (365*60*60*24));  
            $months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));  
$days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24)); 

            
            $jobDetails[0]->postedago=$days;
            $jobDetails[0]->job_preference=str_replace(',', ', ', $jobDetails[0]->job_preference);
            $jobDetails[0]->encId=base64_encode($jobDetails[0]->job_id);
            $savedd=SavedJobs::where(array('user_id'=>$userid,'job_id'=>$jobid))->count();
            if($savedd>0)
            {
                $jobDetails[0]->isSaved=1;
            }else
            {
                $jobDetails[0]->isSaved=0;
            }
            $applied=JobApplications::where(array('user_id'=>$userid,'job_id'=>$jobid))->count();
            if($applied>0)
            {
                $jobDetails[0]->isApplied=1;
            }else
            {
                $jobDetails[0]->isApplied=0;
            }
            $similarjobs=DB::table('jobs')
                    ->select('jobs.*','companies.company_name','companies.company_slug','companies.company_cover_image','companies.company_logo')
                    ->leftjoin('companies','companies.company_id','=','jobs.job_company_id')
                    ->where('jobs.job_company_id',$jobDetails[0]->job_company_id)
                    ->where('jobs.job_id','<>',$jobDetails[0]->job_id)
                    ->where(array('job_status'=>1))
                    ->get();
            
            foreach($similarjobs as $key=>$sjobs)
            {
                $sjobs->encId=base64_encode($sjobs->job_id);
                $similarsaved=SavedJobs::where(array('user_id'=>$userid,'job_id'=>$sjobs->job_id))->count();
                if($similarsaved>0)
                {
                    $sjobs->isSaved=1;
                }else
                {
                    $sjobs->isSaved=0;
                }
                $similarapplied=JobApplications::where(array('user_id'=>$userid,'job_id'=>$sjobs->job_id))->count();
                if($similarapplied>0)
                {
                    $sjobs->isApplied=1;
                    unset($similarjobs[$key]);
                }else
                {
                    $sjobs->isApplied=0;
                }
            }

            $data['jobDetails']=$jobDetails;
            $data['similarjobs']=$similarjobs;
            return $data;
    }

    public function savejob(Request $request)
    {
        $userid=base64_decode($request->input('access_token'));
        $jobid=base64_decode($request->input('jobid'));
        $chck=SavedJobs::where(array('user_id'=>$userid,'job_id'=>$jobid))->count();
        if($chck)
        {
            SavedJobs::where(array('user_id'=>$userid,'job_id'=>$jobid))->delete();
            return 0;
        }else
        {
            SavedJobs::insert(array('user_id'=>$userid,'job_id'=>$jobid));
            return 1;
        }
    }

    public function applyjob(Request $request)
    {
        $userid=base64_decode($request->input('access_token'));
        $jobid=base64_decode($request->input('jobid'));
        $chck=JobApplications::where(array('user_id'=>$userid,'job_id'=>$jobid))->count();
        if($chck)
        {
            return 0;
        }else
        {
            JobApplications::insert(array('user_id'=>$userid,'job_id'=>$jobid,'applicationStatus'=>'Applied'));
            return 1;
        }
    }

    public function getjobseekerdashboard(Request $request)
    {
        $userid=base64_decode($request->input('access_token'));
        User::where('id',$userid)->update(array('last_login'=>date('Y-m-d H:i:s')));
        $data['applied_jobs']=JobApplications::where('user_id',$userid)->count();
        $data['shortlisted']=JobApplications::where(array('user_id'=>$userid,'applicationStatus'=>'Shortlisted'))->count();
        $data['advertisements']=$this->getadverts($userid);
               /* ->where('adv_image','!=','')
                ->inRandomOrder()->limit(2)->get();*/
        $data['savedjobs']=SavedJobs::where(array('user_id'=>$userid))->count();
        return $data;
    }

    public function getsavedjobs(Request $request)
    {
        $jobsearchkeyword= $request->input('jobsearchkeyword');
        $limit=$request->input('limit');
        $userid=base64_decode($request->input('access_token'));
         $jobs=DB::table('jobs')
                ->select('companies.company_name','companies.company_slug','jobs.*')
                ->join('savedJobs','savedJobs.job_id','jobs.job_id')
                ->join('companies','companies.company_id','jobs.job_company_id')
                ->where(function($query) use($jobsearchkeyword){
                    $keyword=explode(' ', $jobsearchkeyword);
                    foreach($keyword as $kw)
                    {
                        if($kw!='')
                        {
                            $query->orWhere('jobs.job_title','LIKE','%'.$kw.'%');
                        }
                    }
                })
                ->where(array('jobs.job_status'=>1))
                ->where(array('savedJobs.user_id'=>$userid))
                ->paginate($limit);
         foreach($jobs as $sjobs)
         {
            $sjobs->encId=base64_encode($sjobs->job_id);
            $similarsaved=SavedJobs::where(array('user_id'=>$userid,'job_id'=>$sjobs->job_id))->count();
                if($similarsaved>0)
                {
                    $sjobs->isSaved=1;
                }else
                {
                    $sjobs->isSaved=0;
                }
                $similarapplied=JobApplications::where(array('user_id'=>$userid,'job_id'=>$sjobs->job_id))->count();
                if($similarapplied>0)
                {
                    $sjobs->isApplied=1;
                }else
                {
                    $sjobs->isApplied=0;
                }
         }
           return   response()->json($jobs);
    }

    public function getapplyjobsdetails(Request $request)
    {
        $id=$request->input('jid');
        return $jobDetails=Job::where('jobs.job_id',base64_decode($id))->first();
    }

    public function getjobquestionnaire(Request $request)
    {
        $jobid=base64_decode($request->input('jid'));
        $jobDetails=Job::where('jobs.job_id',$jobid)->first();
        $data['questionnaire']=Questionnaire::where('questionnaire_id',$jobDetails->job_questionnaire)->first();
        $questions=Question::where('questionnaire_id',$jobDetails->job_questionnaire)->get();
        foreach ($questions as $question) {
            $options=explode(',', $question->options);
            $question->optionsa=$options;
        }
        $data['questions']=$questions;
        return $data;


    }

    public function submitanswers(Request $request)
    {
        $jobid=base64_decode($request->input('jobid'));
        $userid=base64_decode($request->input('access_token'));
        $answers=$request->input('answers');
        JobApplications::where(array('user_id'=>$userid,'job_id'=>$jobid))->update(array('is_questionnaire_submit'=>1,'questionnaire_answers'=>json_encode($answers)));
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
                $query->where('adv_for','Jobseeker');
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

}
