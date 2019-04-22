<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use Session;

class PackageController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
        $this->admin_prefix = "admin";
        $this->employer_prefix= "employer";
        $this->candidate_prefix = "candidate";
        $this->manager_prefix = "manager";
    }

    public function packages()
    {
        $results=Package::all();
    	return view('Admin.Package.packages',compact('results'));
    }
    public function add_edit_packages(Request $request)
    {

        $input=array();
        $input['package_name']=$request->input('package_name');
        $input['package_description']=$request->input('package_description');
        $input['package_price']=$request->input('package_price');
        $input['package_duration']=$request->input('package_duration');
        $input['package_total_jobs']=$request->input('package_total_jobs');
        $input['package_total_resume_download']=$request->input('package_total_resume_download');
        $input['package_total_excel_export']=$request->input('package_total_excel_export');
        $input['package_total_resume_views']=$request->input('package_total_resume_views');
        $input['package_total_resume_forward']=$request->input('package_total_resume_forward');
        $input['package_total_resume_search']=$request->input('package_total_resume_search');
        $input['package_total_email']=$request->input('package_total_email');
        $input['package_total_sms']=$request->input('package_total_sms');
        $input['package_recruitment_service']=$request->input('package_recruitment_service');
        $package_id=$request->input('package_id');
        if($package_id==0)
        {
             $input['package_for']="Employer";
            Package::insert($input);
            Session::flash('message', 'Package Added Successfuly!');
            return 1;
        }else
        {
            Package::where('id',$package_id)->update($input);
            Session::flash('message', 'Package Updated Successfuly!');
            return 1;
        }
        return 0;
    }
    public function get_package_details(Request $request)
    {
        $id=base64_decode($request->input('id'));
        return $rec=Package::where('id',$id)->first();
    }


    public function DeletePackadge(Request $request)
    {
        $id=$request->id;
        $results=Package::where('id',$id)->delete();  
    }


}
