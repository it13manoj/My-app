<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use App\User;
use App\Advertisement;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $em=explode('@',$row[2]);
        $user_username=$em[0];
        $user_token=md5(rand());
        $fn=str_replace(' ', '-', $row[0]);
            $lfn=str_replace(' ', '-', $row[1]);
            $dt=strtotime(date('m-d-Y'));
            $user_slug=$fn.'-'.$lfn.'.'.$dt;

        $pass='12345';
        return new User([
            'user_first_name'=>$row['First_Name'],
            'user_last_name'=>$row['Last_Name'],
            'email'=>$row['Email'],
            'user_username'=>$user_username,
            'user_token'=>$user_token,
            'password'=>Hash::make($pass),
            'user_slug'=>$user_slug,
            'user_status'=>1,
            'user_contact'=>$row['Contact_no'],
            'candidate_type'=>$row['Candidate_Type'],
            'user_role'=>'Jobseeker'
            
        ]);
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
                $query->where('adv_category','LIKE','%Adv_'.$catid.'_cat%');
            })->where(array('adv_status'=>1))
                ->where('adv_image','!=','')
                ->inRandomOrder()->limit(2)->get();
        }
        return $adverts;

    }
}
