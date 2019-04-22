<?php

namespace App\Http\Controllers;

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
use App\City;
use App\User;
use App\Page;
use App\Advertisement;
use App\Company;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.dashboard');
    }

    public function manage_employers()
    {
        return view('Admin.employers');
    }


    /************Setting Items Starts From Here************/
    public function countries()
    {
        $countries=Country::all();
        return view('Admin.country',compact('countries'));
    }

        /**********save / Edit countries*********/
    public function saveUpdateCountries(Request $request){
       $input=array();
       $country_id=$request->input('cid');
       $input['country_name']=$request->input('countryname');
       $input['country_code']=$request->input('countrycode');
       $input['country_currency_code']=$request->input('currency');
       if($country_id==0){
        $input['country_status']=1;
        Session::flash('message', 'Country Added Successfuly!');
        Country::insert($input);
        return 1;
       }else{
        Session::flash('message', 'Country Updated Successfuly!');
        Country::where('country_id',$country_id)->update($input);
        return 1;
       }


    }
        /**********save / Edit countries*********/
        /**********get all countries*********/
    public function get_countries()
    {
       $countries=Country::all();
       $i=1;
       foreach($countries as $country){
        $country->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($countries)
            ->editColumn('status',function($countries){
                if($countries->country_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$countries->country_id.'" class="change_status" idd="'.$countries->country_id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$countries->country_id.'" class="change_status" idd="'.$countries->country_id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($countries) {
                return '<button type="button" style="cursor:pointer" id="'.$countries->country_id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'status','action' => 'action'])
            ->make(true);
    }

    public function get_country_details(Request $request){
       return $country=Country::where('country_id',$request->input('id'))->first();
    }
    /**********get all states*********/
    public function states()
    {
        $countries=Country::All();
        return view('Admin.state',compact('countries'));
    }

        /**********save / Edit states*********/
    public function saveUpdatestates(Request $request){
       $input=array();
       $state_id=$request->input('sid');
       $input['state_name']=$request->input('statename');
       $input['country_id']=$request->input('country');
       
      if($state_id==0){
        $input['state_status']=1;
        State::insert($input);
        Session::flash('message', 'State Added Successfuly!');
        return 1;
       }else{
        Session::flash('message', 'State Updated Successfuly!');
        State::where('state_id',$state_id)->update($input);
        return 1;
       }


    }
        /**********save / Edit states*********/
        /**********get all states*********/
    public function get_states()
    {
       $states=DB::table('states')
                ->select('states.*','countries.country_name')
                ->leftjoin('countries','countries.country_id','=','states.country_id')
                ->get();
       $i=1;
       foreach($states as $state){
        $state->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($states)
            ->editColumn('status',function($states){
                if($states->state_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$states->state_id.'" class="change_status" idd="'.$states->state_id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$states->state_id.'" class="change_status" idd="'.$states->state_id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($states) {
                return '<button type="button" style="cursor:pointer" id="'.$states->state_id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'status','action' => 'action'])
            ->make(true);
    }

    public function get_state_details(Request $request){
       return $state=State::where('state_id',$request->input('id'))->first();
    }
    /**********get all states*********/




    /**********get all cities*********/
    public function cities()
    {
        $countries=Country::All();
        return view('Admin.city',compact('countries'));
    }

        /**********save / Edit states*********/
    public function saveUpdatecities(Request $request){
       $input=array();
       $city_id=$request->input('cid');
       $input['city_name']=$request->input('city_name');
       $input['state_id']=$request->input('state');
       $input['country_id']=$request->input('country');
       
      if($city_id==0){
        $input['city_status']=1;
        City::insert($input);
        Session::flash('message', 'City Added Successfuly!');
        return 1;
       }else{
        Session::flash('message', 'City Updated Successfuly!');
        City::where('city_id',$city_id)->update($input);
        return 1;
       }


    }
        /**********save / Edit cities*********/
        /**********get all cities*********/
    public function get_cities()
    {
       $cities=DB::table('cities')
                ->select('cities.*','countries.country_name','states.state_name')
                ->leftjoin('states','states.state_id','=','cities.state_id')
                ->leftjoin('countries','countries.country_id','=','cities.country_id')
                ->get();
       $i=1;
       foreach($cities as $city){
        $city->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($cities)
            ->editColumn('status',function($cities){
                if($cities->city_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$cities->city_id.'" class="change_status" idd="'.$cities->city_id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$cities->city_id.'" class="change_status" idd="'.$cities->city_id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($cities) {
                return '<button type="button" style="cursor:pointer" id="'.$cities->city_id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'status','action' => 'action'])
            ->make(true);
    }

    public function get_city_details(Request $request){
       return $city=City::where('city_id',$request->input('id'))->first();
    }
    /**********get all states*********/
    /************change status**********/
    public function change_status(Request $request)
    {
        $statusof=$request->input('status_of');
        $id=$request->input('id');
        if($statusof=='country')
        {
            $chck=Country::where('country_id',$id)->first();
            Country::where('country_id',$id)->update(array('country_status'=>!$chck->country_status));
            if($chck->country_status==1){
                return 1;
            }else{
                return 0;
            }
        }
        if($statusof=='advert')
        {
            $chck=Advertisement::where('id',$id)->first();
            Advertisement::where('id',$id)->update(array('adv_status'=>!$chck->adv_status));
            if($chck->adv_status==1){
                return 1;
            }else{
                return 0;
            }
        }

        if($statusof=='page')
        {
            $chck=Page::where('id',$id)->first();
            Page::where('id',$id)->update(array('status'=>!$chck->status));
            if($chck->status==1){
                return 1;
            }else{
                return 0;
            }
        }
        if($statusof=='state')
        {
            $chck=State::where('state_id',$id)->first();
            State::where('state_id',$id)->update(array('state_status'=>!$chck->state_status));
            if($chck->state_status==1){
                return 1;
            }else{
                return 0;
            }
        }
        if($statusof=='city')
        {
            $chck=City::where('city_id',$id)->first();
            City::where('city_id',$id)->update(array('city_status'=>!$chck->city_status));
            if($chck->city_status==1){
                return 1;
            }else{
                return 0;
            }
        }
         if($statusof=='category')
        {
            $chck=Category::where('category_id',$id)->first();
            Category::where('category_id',$id)->update(array('category_status'=>!$chck->category_status));
            if($chck->category_status==1){
                return 1;
            }else{
                return 0;
            }
        }
        if($statusof=='subcategory')
        {
            $chck=SubCategory::where('subcategory_id',$id)->first();
            SubCategory::where('subcategory_id',$id)->update(array('subcategory_status'=>!$chck->subcategory_status));
            if($chck->subcategory_status==1){
                return 1;
            }else{
                return 0;
            }
        }
        if($statusof=='user')
        {
            $chck=User::where('id',$id)->first();
            User::where('id',$id)->update(array('user_status'=>!$chck->user_status));
            if($chck->user_status==1){
                return 1;
            }else{
                return 0;
            }
        }
        if($statusof=='company')
        {
            $chck=Company::where('company_id',$id)->first();
            Company::where('company_id',$id)->update(array('company_status'=>!$chck->company_status));
            if($chck->company_status==1){
                return 1;
            }else{
                return 0;
            }
        }
    }
    /************change status**********/
    /************fetch states***********/
    public function fetch_states(Request $request)
    {
        $cid=$request->input('id');
        $states=State::where('country_id',$cid)->get();
        $html='';
         $html.='<option value="">Select State</option>';
        if(sizeof($states)>0)
        {
           
            foreach($states as $state){
                $html.='<option value="'.$state->state_id.'">'.$state->state_name.'</option>';
            }
        }else
        {
            $html.='<option value="">No Recoreds Found</option>';
        }
        return $html;
    }
    /************fetch states***********/

     /************Setting Items Starts From Here************/
    public function pages()
    {
        $pages=Page::all();
        return view('Admin.pages',compact('pages'));
    }

        /**********save / Edit pages*********/
    public function saveUpdatePages(Request $request){
       $input=array();
       $page_id=$request->input('pid');
       $input['page_name']=$request->input('pagename');
       $input['description']=$request->input('description');
       $input['position']=$request->input('position');
       $fn=str_replace(' ', '-', $request->input('pagename'));
        $dt=strtotime(date('m-d-Y'));
        $input['slug']=$fn.'-'.$dt;
       if($page_id==0){
        $input['status']=1;
        
        Page::insert($input);
        Session::flash('message', 'Page Added Successfuly!');
        return redirect()->back();
        return 1;
       }else{
        Session::flash('message', 'Page Updated Successfuly!');
        Page::where('id',$page_id)->update($input);
        return redirect()->back();
        return 1;
       }


    }
        /**********save / Edit pages*********/
        /**********get all pages*********/
    public function get_pages()
    {
       $pages=Page::all();
       $i=1;
       foreach($pages as $page){
        $page->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($pages)
            ->editColumn('pstatus',function($pages){
                if($pages->status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$pages->id.'" class="change_status" idd="'.$pages->id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$pages->id.'" class="change_status" idd="'.$pages->id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($pages) {
                return '<button type="button" style="cursor:pointer" id="'.$pages->id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'pstatus','action' => 'action'])
            ->make(true);
    }

    public function get_page_details(Request $request){
       return $page=Page::where('id',$request->input('id'))->first();
    }
    /**********get all states*********/
  /****************advertisments************/
  public function advertisments()
    {
        $ads=Advertisement::all();
        $industry=Category::where('category_status',1)->get();
        return view('Admin.advertisements',compact('ads','industry'));
    }

        /**********save / Edit advertisments*********/
    public function saveUpdateadvertisments(Request $request){
       $input=array();
       $adv_id=$request->input('aid');
       $input['adv_title']=$request->input('adv_title');
       $input['adv_link']=$request->input('adv_link');
       $input['advStartDate']=$request->input('advStartDate');
       $input['adv_category']=implode(',', $request->input('adv_category'));
       $input['advEndDate']=$request->input('advEndDate');
       $input['adv_for']=$request->input('adv_for');
       /****upload advert image********/
       if($request->hasFile('advimg')){
            $advimg=$request->file('advimg');
            if(!file_exists('admin_assets/uploaded_images/adv_pic')){
                mkdir('admin_assets/uploaded_images/adv_pic',0777,true);
            }
             $destinationPath =public_path('admin_assets/uploaded_images/adv_pic');
             /*$filename=$this->uploadfile($companyLogo,$destinationPath);
             $input['company_logo']=$filename;*/
            $input['adv_image']=str_random(10).'.'.$advimg->getClientOriginalExtension();
            $uploadSuccess   = $advimg->move($destinationPath, $input['adv_image']);
        }else{
            $input['adv_image']=$request->input('oldimg');
        }



       if($adv_id==0){
        Advertisement::insert($input);
        Session::flash('message', 'Advertisement Added Successfuly!');
        return redirect()->back();
        return 1;
       }else{
        Session::flash('message', 'Advertisement Updated Successfuly!');
        Advertisement::where('id',$adv_id)->update($input);
        return redirect()->back();
        return 1;
       }


    }
        /**********save / Edit pages*********/
        /**********get all pages*********/
    public function get_advertisments()
    {
       $advertisments=Advertisement::all();
       $i=1;
       foreach($advertisments as $advertisment){
        $advertisment->serial=$i;
        $i=$i+1;
       }
        return DataTables::of($advertisments)
            ->editColumn('status',function($advertisments){
                if($advertisments->adv_status==1){
                    $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$advertisments->id.'" class="change_status" idd="'.$advertisments->id.'"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>';
                            return $html;
                    }else{
                        $html='';
                    $html.= '<a style="cursor:pointer" type="button" id="status_'.$advertisments->id.'" class="change_status" idd="'.$advertisments->id.'"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>';
                            return $html;
                    }
                })
            ->addColumn('action', function ($advertisments) {
                return '<button type="button" style="cursor:pointer" id="'.$advertisments->id.'" class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></button>';
        })
            ->rawColumns(['status' => 'status','action' => 'action'])
            ->make(true);
    }

    public function get_advertisments_details(Request $request){
       $advertisments=Advertisement::where('id',$request->input('id'))->first();
       $advertisments->categories=explode(',', $advertisments->adv_category);
       return $advertisments;
    }
    /************Setting Items Ends Here************/
}
