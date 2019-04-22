<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use Hash;
use Session;
use DataTables;
use App\Country;
use App\State;
use App\Category;
use App\SubCategory;
use App\User;
use App\Job;
use App\City;
use App\Company;
use Intervention\Image\Facades\Image;
use App\Imports\UsersImport;
use Excel;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->admin_prefix = "admin";
        $this->employer_prefix= "employer";
        $this->candidate_prefix = "candidate";
        $this->manager_prefix = "manager";
    }

      /**********get all Category*********/
    public function jobcategories()
    {
         return view('Admin.category');
    }

        /**********save / Edit category*********/
    public function saveUpdatejobcategories(Request $request){
       $input=array();
       $category_id=$request->input('cid');
       $input['category_name']=$request->input('catname');
       
      if($category_id==0){
      	$input['category_for']='Job';
        $input['category_status']=1;
        Category::insert($input);
        Session::flash('message', 'Industry Added Successfuly!'); 
        return 1;
       }else{
        Category::where('category_id',$category_id)->update($input);
        Session::flash('message', 'Industry Updated Successfuly!');
        return 1;
       }


    }
        /**********save / Edit Category*********/
        /**********get all Category*********/
    public function get_jobcategories()
    {
       $category=Category::all();
       $i=1;
       foreach($category as $cat){
        $cat->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($category)
            ->editColumn('status',function($category){
                if($category->category_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$category->category_id.'" class="change_status" idd="'.$category->category_id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{

                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$category->category_id.'" class="change_status" idd="'.$category->category_id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->editColumn('featured',function($category){
                if($category->featured==1){
                    $html='';
                    
                    $html.='<input type="checkbox" class="markfeature" id="featured'.$category->category_id.'" idd="'.$category->category_id.'" checked>';
                            return $html;
                    }else{
                      
                        $html='';
                    $html.='<input type="checkbox" class="markfeature" id="featured'.$category->category_id.'" idd="'.$category->category_id.'">';
                            return $html;
                    }
                })
            ->addColumn('action', function ($category) {
                return '<button type="button" style="cursor:pointer" id="'.$category->category_id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'status','action' => 'action','featured'=>'featured'])
            ->make(true);
    }

    public function get_jobcategory_details(Request $request){
       return $category=Category::where('category_id',$request->input('id'))->first();
    }
    /**********get all category*********/

     /**********get all subCategory*********/
    public function jobsubcategories()
    {
    	$category=Category::all();
         return view('Admin.subcategory',compact('category'));
    }

        /**********save / Edit category*********/
    public function saveUpdatejobsubcategories(Request $request){
       $input=array();
       $subcategory_id=$request->input('scid');
       $input['subcategory_name']=$request->input('scatname');
       $input['category_id']=$request->input('category');
       
      if($subcategory_id==0){
      	$input['subcategory_for']='Job';
        $input['subcategory_status']=1;
        SubCategory::insert($input);
        Session::flash('message', 'Functional Area Added Successfuly!');
        return 1;
       }else{
        SubCategory::where('subcategory_id',$subcategory_id)->update($input);
        Session::flash('message', 'Functional Area Updated Successfuly!');
        return 1;
       }


    }
        /**********save / Edit subCategory*********/
        /**********get all subCategory*********/
    public function get_jobsubcategories()
    {
       $subcategory=DB::table('subcategories')
       			->select('subcategories.*','categories.category_name')
       			->leftjoin('categories','categories.category_id','=','subcategories.category_id')
       			->get();
       $i=1;
       foreach($subcategory as $scat){
        $scat->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($subcategory)
            ->editColumn('status',function($subcategory){
                if($subcategory->subcategory_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$subcategory->subcategory_id.'" class="change_status" idd="'.$subcategory->subcategory_id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$subcategory->subcategory_id.'" class="change_status" idd="'.$subcategory->subcategory_id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($subcategory) {
                return '<button type="button" style="cursor:pointer" id="'.$subcategory->subcategory_id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'status','action' => 'action'])
            ->make(true);
    }

    public function get_jobsubcategory_details(Request $request){
       return $subcategory=SubCategory::where('subcategory_id',$request->input('id'))->first();
    }
    /**********get all category*********/
    /**/////////////////////////*****/
    /*Companies module start from hrere*/
    /**/////////////////////////*****/
    public function companies(Request $request)
    {
      $search='';
      if($request->has('search'))
      {
        $search=$request->input('search');
        $companies=Company::where(function($query) use($search){
                      if($search!='')
                      {
                        $sear=explode(' ',$search);
                        foreach($sear as $srch)
                        {
                          if($srch!='')
                          {
                            $query->orwhere('company_name','LIKE','%'.$srch.'%');
                          }
                        }
                      }
                    })->paginate(10);
      }else
      {
        $companies=Company::paginate(10);
      }


      
      return view('Admin.Company.company',compact('companies','search'));
    }

    public function edit_company($id)
    {
      $company_id=base64_decode($id);
      $company=Company::where('company_id',$company_id)->first();
      $category=Category::select('category_id','category_name')->where('category_status',1)->get();
      $country=Country::select('country_id','country_name')->where('country_status',1)->get();
      $employers=User::select('id','user_first_name','user_last_name')->where('user_role','Employer')->get();
      return view('Admin.Company.add_edit_company',compact('category','company','country','employers'));
    }

    public function add_edit_company()
    {
      $company=array();
      $category=Category::select('category_id','category_name')->where('category_status',1)->get();
      $country=Country::select('country_id','country_name')->where('country_status',1)->get();
      $employers=User::select('id','user_first_name','user_last_name')->where('user_role','Employer')->get();
      return view('Admin.Company.add_edit_company',compact('category','country','company','employers'));
    }

    public function save_update_company(Request $request)
    { 
      $input=array();
      $company_id=$request->input('cid');
      $input['company_name']=$request->input('companyname');
      $input['company_category']=$request->input('category');
      $input['company_email']=$request->input('company_email');
      $input['company_contact']=$request->input('company_contact');
      $input['company_website']=$request->input('company_website');
      $input['number_of_employees']=$request->input('number_of_employees');
      $input['company_capital']=$request->input('company_capital');
      $fn=str_replace(' ', '-', $request->input('companyname'));
      $dt=strtotime(now());
      $input['company_slug']=$fn.'-'.$dt;

      $input['company_sales']=$request->input('company_sales');
      $input['company_corporate_number']=$request->input('company_corporate_number');
      $input['company_establish_date']=$request->input('company_establish_date');
      $input['company_fb']=$request->input('company_fb');
      $input['company_twitter']=$request->input('company_twitter');
      $input['company_google_plus']=$request->input('company_google_plus');
      $input['company_linked_in']=$request->input('company_linked_in');
      $input['company_owner']=$request->input('owner');
      $input['company_country']=$request->input('country');
      $input['company_state']=$request->input('state');
      $input['company_city']=$request->input('city');
      $input['company_address']=$request->input('company_address');
      $input['company_lat']=$request->input('latt');
      $input['company_long']=$request->input('longg');
      $input['company_about']=$request->input('company_about');
      /*************upload logo***********/
      if($request->hasFile('companyLogo')){
            $companyLogo=$request->file('companyLogo');
            if(!file_exists('admin_assets/uploaded_images/company_pic')){
                mkdir('admin_assets/uploaded_images/company_pic',0777,true);
            }
             $destinationPath =public_path('admin_assets/uploaded_images/company_pic');
             $filename=$this->uploadfile($companyLogo,$destinationPath);
             $input['company_logo']=$filename;
           /* $destinationPath ='admin_assets/uploaded_images';
            $filename        = str_random(10) . '.' . $companyLogo->getClientOriginalExtension();
            $uploadSuccess   = $companyLogo->move($destinationPath, $filename);*/
        }/*else{
            $filename='';
        }*/
        

        if($company_id==0)
        {
          Company::insert($input);
        Session::flash('message', 'Company Added Successfuly!');
        }else{
          Company::where('company_id',$company_id)->update($input);
          Session::flash('message', 'Company Updated Successfuly!');
        }

        return redirect($this->manager_prefix.'/companies');
        /*************upload logo***********/
    }

    /**/////////////////////////*****/
    /*Companies module ends here*/
    /**/////////////////////////*****/

     /**/////////////////////////*****/
    /*Employer module starts from here*/
    /**/////////////////////////*****/
    public function employers()
    {
      $industry=Category::where('category_status',1)->get();
      $functional=SubCategory::where('subcategory_status',1)->get();
      return view('Admin.Employer.employer',compact('functional','industry'));
    }

    public function add_edit_employers()
    {
      $companies=Company::all();
      return view('Admin.Employer.add_edit_employer',compact('companies'));
    }
     public function editemployer($id)
    {
      $companies=Company::all();
      $userdetails=User::where('id',base64_decode($id))->first();
      return view('Admin.Employer.edit_employer',compact('companies','userdetails'));
    }

    public function save_update_employers(Request $request)
    {
      $user_id=$request->input('user_id');
      $input=array();
      //$input['user_name']=$request->input('user_name');
      if($request->input('user_first_name')!='' && $request->input('user_last_name')!='' && $request->input('email')!=''){
         $fn=str_replace(' ', '-', $request->input('user_first_name'));
                          $lfn=str_replace(' ', '-', $request->input('user_last_name'));
                          $dt=strtotime(date('m-d-Y'));
                          $input['user_slug']=$fn.'-'.$lfn.'-'.$dt;
                          
      $input['user_first_name']=$request->input('user_first_name');
      $input['user_last_name']=$request->input('user_last_name');
      $input['email']=$request->input('email');
      $input['user_company']=$request->input('user_company');
      $input['user_designation']=$request->input('user_designation');
      $input['user_contact']=$request->input('user_contact');
      $input['user_about']=$request->input('user_about');

    }
      if($request->input('password')!=''){
        $input['password']=Hash::make($request->input('password'));
      }
      
      /*************upload logo***********/
      if($request->hasFile('user_image')){
            $user_image=$request->file('user_image');
           /* if(!file_exists('admin_assets/uploaded_images/profile_pic')){
                mkdir('admin_assets/uploaded_images/profile_pic',0777,true);
            }*/
            $destinationPath =public_path('admin_assets/uploaded_images/profile_pic');
             $input['user_profile_picture']=$this->uploadfile($user_image,$destinationPath);
            /*$filename        = str_random(10) . '.' . $user_image->getClientOriginalExtension();
            $uploadSuccess   = $user_image->move($destinationPath, $filename);*/
           
        }else{
            $filename=$request->input('oldimage');
            $input['user_profile_picture']=$filename;
        }
        

        /*************upload logo***********/
        if($user_id==0)
        {
          $input['user_token']=md5(rand());
          $input['user_role']='Employer';
          $em=explode('@',$request->input('email'));
          $input['user_username']=$em[0];
          

          $user_id = User::insertGetId($input);
          Session::flash('message', 'Employer Profile Added Successfuly!');
        }else{
          Session::flash('message', 'Employer Profile Updated Successfuly!');
          User::where('id',$user_id)->update($input);
        }
        return redirect($this->manager_prefix.'/employer_profile/'.base64_encode($user_id));
    }


    public function get_employers(){
       $employers=DB::table('users')
                ->select('users.*','companies.company_name','categories.category_id','categories.category_name','subcategories.subcategory_id','subcategories.subcategory_name')
                ->where('user_role','Employer')
                ->leftjoin('companies','companies.company_id','=','users.user_company')
                ->leftjoin('categories','categories.category_id','=','users.user_industry')
                ->leftjoin('subcategories','subcategories.subcategory_id','=','users.user_functional_area')
                ->get();
       $i=1;
       foreach($employers as $employer){
        $employer->serial=$i;
        $employer->created_on=date('M d,Y',strtotime($employer->created_at));
        $i=$i+1;
       }
        return DataTables::of($employers)
            ->editColumn('status',function($employers){
                if($employers->user_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$employers->id.'" class="change_status" idd="'.$employers->id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$employers->id.'" class="change_status" idd="'.$employers->id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($employers) {
                return '<a href="'.url("/").'/manager/editemployer/'.base64_encode($employers->id).'" style="cursor:pointer"  class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></a>  <a href="'.url("/").'/manager/employer_profile/'.base64_encode($employers->id).'" style="cursor:pointer"  class="btn btn-primary editbtn"><i class="fa fa-eye">View</i></a>';
              
        })
            ->editColumn('featured',function($employers){
                if($employers->user_can_edit_comp==1){
                    $html='';
                    
                    $html.='<input type="checkbox" class="markfeature" id="featured'.$employers->id.'" idd="'.$employers->id.'" checked>';
                            return $html;
                    }else{
                      
                        $html='';
                    $html.='<input type="checkbox" class="markfeature" id="featured'.$employers->id.'" idd="'.$employers->id.'">';
                            return $html;
                    }
                })
            ->addColumn('userimg', function ($employers) {
                if($employers->user_profile_picture!=''){
                   return '<img src="'.url("/").'/admin_assets/uploaded_images/profile_pic/thumb/'.$employers->user_profile_picture.'" style="height:50px !important;width:50px !important;"></br>'.$employers->user_first_name.' '.$employers->user_last_name;
                 }else{
                return $employers->user_first_name.' '.$employers->user_last_name.'</br><img src="'.url("/").'/admin_assets/images/profile-default.png" style="height:50px !important;width:50px !important;">';
                }
              })
            ->rawColumns(['status' => 'status','action' => 'action','userimg'=>'userimg','featured'=>'featured'])
            ->make(true);
    }


    public function employer_profile($id)
    {
      $userid=base64_decode($id);
      $companies=Company::all();
      $userdetails=User::where('id',$userid)->first();
      return view('Admin.Employer.employer_profile',compact('companies','userdetails'));

    }

    public function checkemail(Request $request)
    {
        $email=$request->input('email');
        $uid=$request->input('uid');
        if($uid==0)
        {
          $chck=User::where('email',$email)->count();
          if($chck>0)
          {
            return 1;
          }else{
            return 0;
          }
        }else{
          $chck=User::where('email',$email)->first();
          if($chck){
            if($chck->id==$uid){
              return 0;
            }else{
              return 1;
            }
          }else{
            return 0;
          }
        }
    }
    public function checkemailadmin(Request $request)
    {
        $email=$request->input('email');
        $uid=$request->input('uid');
        if($uid==0)
        {
          $chck=DB::table('admins')->where('email',$email)->count();
          if($chck>0)
          {
            return 1;
          }else{
            return 0;
          }
        }else{
          $chck=DB::table('admins')->where('email',$email)->first();
          if($chck){
            if($chck->id==$uid){
              return 0;
            }else{
              return 1;
            }
          }else{
            return 0;
          }
        }
    }

    /**/////////////////////////*****/
    /*Employer module ends here*/
    /**/////////////////////////*****/

    /**/////////////////////////*****/
    /*Jobseeker module starts here*/
    /**/////////////////////////*****/
    
    public function jobseekers(Request $request)
    {
      $search='';
      $industry='';
      $experience='';
      $expsalary='';
      if($request->has('search') || $request->has('industries') || $request->has('experience') || $request->has('expectedsalary')){
        $search=$request->input('search');
        $industry=$request->input('industries');
        $experience=$request->input('experience');
        $expsalary=$request->input('expectedsalary');
        //print_r($industry);die;
           $jobseekers=User::where('user_role','Jobseeker')
                        ->where(function($query) use ($industry){
                            //$industry=explode(',', $industry);

                            if($industry)
                            {

                                foreach($industry as $indus)
                                {
                                    if($indus!=''){
                                        $query->orwhere('user_industry',$indus);
                                    }
                                }
                            }
                        })
                        ->where(function($query) use ($expsalary){
                              if($expsalary)
                              {
                                  foreach($expsalary as $expsal)
                                  {
                                      if($expsal!=''){
                                          $expssal=explode('-',$expsal);

                                          //$query->orwhere('jobs.job_category',$indus);
                                          $query->orwhere([
                                              ['user_expected_salary','>=',$expssal[0]],
                                              ['user_expected_salary','<=',$expssal[1]],
                                          ]);
                                          
                                      }
                                  }
                              }
                          })
                        ->where(function($query) use ($experience){
                              if($experience)
                              {
                                  foreach($experience as $exps)
                                  {
                                      if($exps!=''){
                                          $expss=explode('-',$exps);

                                          //$query->orwhere('jobs.job_category',$indus);
                                          $query->orwhere([
                                              ['user_experience_year','>=',$expss[0]],
                                              ['user_experience_year','<=',$expss[1]],
                                          ]);
                                          
                                      }
                                  }
                              }
                          })
                        ->where(function($query) use($search){
                                    if($search!='')
                                    {
                                      $s=explode(' ', $search);
                                      foreach($s as $key)
                                      {
                                        $query->where('user_first_name','LIKE','%'.$key.'%');
                                        $query->orWhere('user_last_name','LIKE','%'.$key.'%');
                                        $query->orWhere('email','LIKE','%'.$key.'%');
                                        $query->orWhere('user_contact','LIKE','%'.$key.'%');
                                      }
                                    }
                                  })->paginate(10);  
      }else
      {
        $jobseekers=User::where('user_role','Jobseeker')->paginate(10);  
      }
     $category=Category::select('category_id','category_name','featured')->where('category_status',1)->get();
      return view('Admin.Jobseeker.jobseeker',compact('industry','experience','expsalary','jobseekers','category','search'));
    }

    public function add_jobseeker()
    {
      return view('Admin.Jobseeker.add_edit_jobseeker');
    }
     public function editjobseeker($id)
    {
      $userdetails=User::where('id',base64_decode($id))->first();
      return view('Admin.Jobseeker.edit_jobseeker',compact('userdetails'));
    }

    public function save_update_jobseeker(Request $request)
    {
      $user_id=$request->input('user_id');
      $input=array();
      //$input['user_name']=$request->input('user_name');
      if($request->input('user_first_name')!='' && $request->input('user_last_name')!='' && $request->input('email')!=''){
      $input['user_first_name']=$request->input('user_first_name');
      $input['user_last_name']=$request->input('user_last_name');
      $input['email']=$request->input('email');
      $fn=str_replace(' ', '-', $request->input('user_first_name'));
                          $lfn=str_replace(' ', '-', $request->input('user_last_name'));
                          $dt=strtotime(date('m-d-Y'));
                          $input['user_slug']=$fn.'-'.$lfn.'-'.$dt;

      $input['user_contact']=$request->input('user_contact');
      $input['user_about']=$request->input('user_about');

    }
      if($request->input('password')!=''){
        $input['password']=Hash::make($request->input('password'));
      }
      
      /*************upload logo***********/
      if($request->hasFile('user_image')){
            $user_image=$request->file('user_image');
           /* if(!file_exists('admin_assets/uploaded_images/profile_pic')){
                mkdir('admin_assets/uploaded_images/profile_pic',0777,true);
            }*/
            $destinationPath =public_path('admin_assets/uploaded_images/profile_pic');
             $filename=$this->uploadfile($user_image,$destinationPath);
             $input['user_profile_picture']=$filename;
             $input['user_profile_pic_thumb']=$filename;
            /*$filename        = str_random(10) . '.' . $user_image->getClientOriginalExtension();
            $uploadSuccess   = $user_image->move($destinationPath, $filename);*/
           
        }else{
            $filename=$request->input('oldimage');
            $input['user_profile_picture']=$filename;
        }
        

        /*************upload logo***********/
        if($user_id==0)
        {
          $input['user_token']=md5(rand());
          $input['user_role']='Jobseeker';
          $em=explode('@',$request->input('email'));
          $input['user_username']=$em[0];
          
          Session::flash('message', 'Candidate Profile Added Successfuly!');
          $user_id = User::insertGetId($input);
        }else{
          Session::flash('message', 'Candidate Profile Updated Successfuly!');
          User::where('id',$user_id)->update($input);
        }
        return redirect()->route('jobseekers');
       // return redirect($this->manager_prefix.'/employer_profile/'.base64_encode($user_id));
    }
    /**/////////////////////////*****/
    /*Jobseeker module ends here*/
    /**/////////////////////////*****/

    /***********upload image function******************/
        /**************function for uploading single image**************/
    public function uploadfile($file,$destinationPath){
                if(!file_exists($destinationPath)){
                    mkdir($destinationPath,0777,true);
                }
              //  $destinationPath =$destinationPath);
                if(!file_exists($destinationPath.'/thumb')){
                    mkdir($destinationPath.'/thumb',0777,true);
                }
                $thumbdestinationPath =$destinationPath.'/thumb';
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
    /***********upload image function******************/

    public function importusingexcel(Request $request)
    {
      //dd($request->file());die;
       if($request->hasFile('excelfile')){
        //echo "here";die;
            $path = $request->file('excelfile')->getRealPath();
            $data = Excel::load($path)->get();
            if($data->count()){
             /* print_r($data);die;*/
                foreach ($data as $key => $value) {
                     $em=explode('@',$value->email);
                      $user_username=$em[0];
                      $user_token=md5(rand());
                      $fn=str_replace(' ', '-', $value->first_name);
                          $lfn=str_replace(' ', '-', $value->last_name);
                          $dt=strtotime(date('m-d-Y'));
                          $user_slug=$fn.'-'.$lfn.'-'.$dt;

                      $pass='12345';
                    $chck=User::where('email',$value->email)->count();
                    if($chck<1){
                      if($value->email!=''){
                      $arr[] =  [
                        'user_first_name'=>$value->first_name,
                        'user_last_name'=>$value->last_name,
                        'email'=>$value->email,
                        'user_username'=>$user_username,
                        'user_token'=>$user_token,
                        'password'=>Hash::make($pass),
                        'user_slug'=>$user_slug,
                        'user_status'=>1,
                        'user_contact'=>$value->contact_no,
                        'candidate_type'=>$value->candidate_type,
                        'user_role'=>'Jobseeker'
                    ];
                  }
                    /********sendmail*******/
                      $toemail = $value->email;
                      $appname=\Config::get('app.name');
                          $secidtoview = array('id' => $user_token,'name' => $value->first_name);
                          if($toemail!=''){
                          Mail::send('emails.reg',$secidtoview,function($message) use ($toemail,$appname) {
                              $message->to($toemail)->subject('Account Verification')->from('admin@naukriyan.com',$appname);
                          });
                        }
                 
                  }

                }
                if(!empty($arr)){
                    User::insert($arr);
                    Session::flash('message', 'Users Added Successfuly!');
                    return redirect()->back();
                }else
                {
                  Session::flash('message', 'Some error occured!');
                    return redirect()->back();
                }
            }
        }
        dd('Request data does not have any files to import.');  
    }

    public function markfeature(Request $request)
    {
        $id=$request->input('id');
        $type=$request->input('type');
        if($type=='category'){
          $ct=Category::where('category_id',$id)->first();
          if($ct->featured==0)
          {
            Category::where('category_id',$id)->update(array('featured'=>1));
            return 1;
          }else
          {
            Category::where('category_id',$id)->update(array('featured'=>0));
            return 1;
          }
        }
        if($type=='employer')
        {
          $ct=User::where('id',$id)->first();
          if($ct->user_can_edit_comp==0)
          {
            User::where('id',$id)->update(array('user_can_edit_comp'=>1));
            return 1;
          }else
          {
            User::where('id',$id)->update(array('user_can_edit_comp'=>0));
            return 1;
          } 
        }
    }

    public function markas(Request $request)
    {
      $id=$request->input('id');
      $type=$request->input('type');
      $status=$request->input('status');
      if($type=='featured')
      {
        Company::where('company_id',$id)->update(array('is_marked_featured'=>$status));
      }
      if($type=='top')
      {
        Company::where('company_id',$id)->update(array('is_marked_top'=>$status));
      }
      return 1;

    }
    public function managejobapplication(Request $request,$jid)
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







    public function parent(){
      $data['ParentMenu']= DB::table('parent_menu')->where('parent_status',1)->get();
      
      return view('Admin.UserRole.parent',$data);
    }

    public function child(){
      $data['Child']=DB::table('child_menu')
                ->select('child_menu.*','parent_menu.parent_id','parent_menu.parent_name','parent_menu.parent_link')
                ->leftjoin('parent_menu','parent_menu.parent_id','=','child_menu.child_parent_menu_id')
                ->orderBy('created_at','DESC')
                ->get();

         $data['Moderator']= DB::table('admins')->where('user_role','moderator')->get();

       $data['ParentMenu']= DB::table('parent_menu')->where('parent_status',1)->get();
      return view('Admin.UserRole.child',$data);
    }

    public function child_status(Request $request){
      if($request->value=="active"){
          $input['child_status']=$request->s;
      }else{
           $input['child_status']=$request->s;
      }
       $id=$request->id;
      $resule=DB::table('child_menu')->where('child_id',$id)->update($input);

      $Child=DB::table('child_menu')
                ->select('child_menu.*','parent_menu.parent_id','parent_menu.parent_name','parent_menu.parent_link')
                ->leftjoin('parent_menu','parent_menu.parent_id','=','child_menu.child_parent_menu_id')->where('child_menu.child_id',$id)
                ->orderBy('created_at','DESC')
                ->get();
               
                foreach($Child as $row) ?>
                    
                       <td><input type="checkbox" name="checkbox[]" value="<?php  echo $row->child_id ; ?>" class="chechbox" idd="<?php  echo $row->child_id ; ?>"></td>
                       <td> <?php  echo $row->parent_name ; ?></td>
                       <td> <?php  echo $row->child_menu_name ; ?></td>
                       <td><span style="cursor:pointer" onclick="childEditMenu(<?php echo $row->child_id; ?>);" class="btn btn-outline-primary editbtn"><i class="fa fa-edit" >Edit</i></span></td>
                       <td>
                        <?php if($row->child_status==1){ ?>
                        <span class="btn btn-success" onclick="ProformeStatus('active',0,<?php echo $row->child_id; ?>)" idd="{{$row->child_id}}">Actie</span>
                        <?php }else{?>
                         <span class="btn btn-danger"  onclick="ProformeStatus('inactive',1,<?php echo $row->child_id; ?>)" idd="<?php $row->child_id; ?>">Inactie</span>
                        
                       <?php } ?>
                      </td>
               <?php
    }

    public function alertchildrole(Request $request){
      $id=$request->input('id');
      $moderator=$request->input('moderator');
      $input['emp_id']= $moderator;
      $input['child_id']= $id;
      if($request->input('category')=="yes"){
      DB::table('employeewiserole')->insert($input);
      }elseif($request->input('category')=="no"){
      DB::table('employeewiserole')->where('emp_id',$moderator)->where('child_id',$id)->delete();
      }
    }



    public function gEtEmpLoYeRolE(Request $request){
      $Child=DB::table('child_menu')
                ->select('child_menu.*','parent_menu.parent_id','parent_menu.parent_name','parent_menu.parent_link')
                ->leftjoin('parent_menu','parent_menu.parent_id','=','child_menu.child_parent_menu_id')
                ->orderBy('created_at','DESC')
                ->get();
                $eid=0;
                foreach($Child as $row){
                $empid=$request->input('id');
                $child=$row->child_id;
               $checked=DB::table('employeewiserole')->where('child_id',$child)->where('emp_id',$empid)->get();
               if(!empty($checked)){
               foreach($checked as $ck)
                $eid=$ck->child_id;
              }
                 ?>
                  <tr id="replace_<?php  echo $row->child_id ; ?>">
                       <td><input type="checkbox" name="checkbox[]" value="<?php  echo $row->child_id ; ?>" class="chechbox" idd="<?php  echo $row->child_id ; ?>"<?php if($row->child_id==$eid) echo "checked"; ?>></td>
                       <td> <?php  echo $row->parent_name ; ?></td>
                       <td> <?php  echo $row->child_menu_name ; ?></td>
                       <td><span style="cursor:pointer" onclick="childEditMenu(<?php echo $row->child_id; ?>);" class="btn btn-outline-primary editbtn"><i class="fa fa-edit" >Edit</i></span></td>
                       <td>
                        <?php if($row->child_status==1){ ?>
                        <span class="btn btn-success" onclick="ProformeStatus('active',0,<?php echo $row->child_id; ?>)" idd="{{$row->child_id}}">Actie</span>
                        <?php }else{?>
                         <span class="btn btn-danger"  onclick="ProformeStatus('inactive',1,<?php echo $row->child_id; ?>)" idd="<?php $row->child_id; ?>">Inactie</span>
                        
                       <?php } ?>
                      </td>
                    </tr>
               <?php }
    }






    public function userrole(){
      $data['ParentMenu']= DB::table('parent_menu')->where('parent_status',1)->get();
      $data['Moderator']= DB::table('admins')->where('user_role','moderator')->get();
       return view('Admin.UserRole.userrole',$data);
    }

 public function GetDetails(Request $request){
      $employers=$request->input('id');
      $checked=0;
      $ParentMenu= DB::table('parent_menu')->where('parent_status',1)->get();
      foreach($ParentMenu as $row){
        $id=$row->parent_id;
        $menu= DB::table('modetorrole')->where('m_parent_id',$id)->where('modetor_id',$employers)->get();
        if(!empty($menu)){
        foreach($menu as $ft)
        $checked=$ft->m_parent_id;
      }
        ?>
      
      <div class="col-6">
      <div class="form-group">
      <input type="checkbox" name="RoleAlert[]" id="rolealert" value="<?php echo $id=$row->parent_id; ?>" <?php if($id==$checked) echo "checked"; ?>>&nbsp;&nbsp;<?php echo  $row->parent_name ?>
      </div>
      </div>
        <?php 


      }
       
    }





    public function edit_parent(Request $request){
       $input['parent_name']=$request->input('Parent_Menu_Name');
       $input['parent_link']=$request->input('Parent_Menu_Link');
       $id=$request->input('edit');
       $input['parent_rolid']=0;
       if($id==''){
         DB::table('parent_menu')->insert($input);
       }else{
         DB::table('parent_menu')->where('parent_id',$id)->update($input);
       }
       
       return redirect()->route('manager.parent');
    }




public function edit_child(Request $request){
       $input['child_parent_menu_id']=$request->input('Parent_Menu_Name');
       $input['child_menu_name']=$request->input('child_Menu_name');
       $input['child_menu_link']=$request->input('child_Menu_Link');
       $id=$request->input('edit');
       if($id==''){
         DB::table('child_menu')->insert($input);
       }else{
         DB::table('child_menu')->where('child_id',$id)->update($input);
       }
       
       return redirect()->route('manager.child');
    }






public function edit_rolealert(Request $request){
      $id=$request->input('Parent_Menu_Name');
      DB::table('modetorrole')->where('modetor_id',$id)->delete();
      $field=$request->input('RoleAlert');
      if(!empty($field)){
      $size=sizeof($field);
      for($i=0;$i<$size;$i++){
        $input['m_parent_id']=$field[$i];
        $input['modetor_id']=$request->input('Parent_Menu_Name');
        DB::table('modetorrole')->insert($input);
      }
    }
       
       return redirect()->route('manager.userrole');
    }






    public function getParentMenu(Request $request){
      $id=$request->id;
      $ParentMenu= DB::table('parent_menu')->where('parent_id',$id)->get()->toJson();
      echo $ParentMenu;
    }



    public function getChildMenu(Request $request){
      $id=$request->id;
      $ChildMenu= DB::table('child_menu')->where('child_id',$id)->get()->toJson();
      echo $ChildMenu;
    }



    public function sub_admin(){
      $ParentMenu= DB::table('parent_menu')->where('parent_status',1)->get();
      return view('Admin.SubAdmin.edit_subadmin',compact('ParentMenu'));
    }





    public function add_edit_subadmin(Request $request){
      $impre['useragent'] = $request->server('HTTP_USER_AGENT');
      $input['ip'] = $request->ip();
      $user_agent = $request->header('User-Agent');

      $bname = 'Unknown';
      $platform = 'Unknown';

    //First get the platform?
    if (preg_match('/linux/i', $user_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $user_agent)) {
        $platform = 'windows';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$user_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$user_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$user_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$user_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$user_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

       $input['device_name']=$bname.'@'.$platform;
      $input['name']=$request->input('user_first_name').' '.$request->input('user_last_name');
      $input['email']=$request->input('email');
      $input['created_at']=date('Y-m-d H:i:s');
      $input['contact']=$request->input('user_contact');
      $result = ""; 
      $generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopurstuvwxyz";
      for ($i = 1; $i <=6; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
      } 
         $input['userId']=$result;
      $input['user_role']="Moderator";
      if($request->input('password')!=''){
        $input['password']=Hash::make($request->input('password'));
      }
           DB::table('admins')->insert($input);

            $privi['modetor_id']=DB::getPdo()->lastInsertId();
            $privilage=$request->input('privilege');
            $size=sizeof($privilage);
            for($i=0;$i<$size;$i++){
            $privi['m_parent_id']=$privilage[$i];
            DB::table('modetorrole')->insert($privi);
            }

      
        Session::flash('message', 'Employer Profile Added Successfuly!');




            $name=$request->input('user_first_name').' '.$request->input('user_last_name');
            $toemail = $request->input('email');
            $user_token=$request->input('_token');
                      $appname=\Config::get('app.name');
                          $secidtoview = array('id' => $user_token,'name' => $name);
                          if($toemail!=''){
                          Mail::send('emails.reg',$secidtoview,function($message) use ($toemail,$appname) {
                              $message->to($toemail)->subject('Account Verification')->from('admin@naukriyan.com',$appname);
                          });
                        }
       return redirect($this->manager_prefix.'/moderators');
    }




 public function moderators(Request $request)
  {
     $Moderator= DB::table('admins')->where('user_role','Moderator')->get();
     return view('Admin.moderators.moderators',compact('Moderator'));

  }














}
