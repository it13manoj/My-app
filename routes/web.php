<?php
$ADMIN_PREFIX = "admin";
$EMPLOYER_PREFIX = "employer";
$CANDIDATE_PREFIX = "candidate";
$MANAGER_PREFIX = "manager";
Route::get('clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
   // $exitCode = Artisan::call('debugbar:clear');
    return ["status" => 1, "msg" => "Cache cleared successfully!"];
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/','frontend\Home@home');
/*Route::get('/{any}','frontend\Home@home')->where('any','.*');*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**//////////////////////////////////////**/
/*******Admin Routes Starts from here******/
/**//////////////////////////////////////**/
Route::group(['prefix' => $ADMIN_PREFIX], function() use($ADMIN_PREFIX) {
//Route::prefix('admin')->group(function(){
	Route::get('/login','Auth\AdminLoginController@showLoginForm')->name($ADMIN_PREFIX.'.login');
	Route::post('/login','Auth\AdminLoginController@login')->name($ADMIN_PREFIX.'.login.submit');
	Route::get('/', 'AdminController@index')->name($ADMIN_PREFIX.'.dashboard');

	//Password reset
	Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name($ADMIN_PREFIX.'.password.email');
	Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name($ADMIN_PREFIX.'.password.request');
	Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
	Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name($ADMIN_PREFIX.'.password.reset');
});
	//Password reset

Route::group(['prefix' => $MANAGER_PREFIX], function() use($MANAGER_PREFIX) {

	/***********Admin Employer Routes start here**********/
	// Route::get('/employers','AdminController@manage_employers')->name('manager.employers');
	// Route::post('/employers','AdminController@employers_submit')->name('manager.employers.submit');
	/***********Admin Employer Routes ends here**********/

	/***********Admin Country Routes starts here**********/
	Route::get('countries','AdminController@countries')->name($MANAGER_PREFIX.'.countries');
	Route::post('countries','AdminController@saveUpdateCountries')->name($MANAGER_PREFIX.'.countries.submit');
	Route::get('get_countries','AdminController@get_countries')->name($MANAGER_PREFIX.'.get_countries');
	Route::get('get_country_details','AdminController@get_country_details')->name($MANAGER_PREFIX.'.get_country_details');
	/***********Admin Country Routes ends here**********/
	
	/***********Admin State Routes starts here**********/
	Route::get('states','AdminController@states')->name($MANAGER_PREFIX.'.states');
	Route::post('states','AdminController@saveUpdatestates')->name($MANAGER_PREFIX.'.states.submit');
	Route::get('get_states','AdminController@get_states')->name($MANAGER_PREFIX.'.get_states');
	Route::get('get_state_details','AdminController@get_state_details')->name($MANAGER_PREFIX.'.get_state_details');

	/***********Admin State Routes ends here**********/
	/***********Admin City Routes starts here**********/
	Route::get('cities','AdminController@cities')->name($MANAGER_PREFIX.'.cities');
	Route::post('cities','AdminController@saveUpdatecities')->name($MANAGER_PREFIX.'.cities.submit');
	Route::get('get_cities','AdminController@get_cities')->name($MANAGER_PREFIX.'.get_cities');
	Route::get('get_city_details','AdminController@get_city_details')->name($MANAGER_PREFIX.'.get_city_details');
	/***********Admin City Routes ends here**********/
	Route::get('fetch_states','AdminController@fetch_states')->name($MANAGER_PREFIX.'.fetch_states');
	Route::post('change_status','AdminController@change_status')->name($MANAGER_PREFIX.'.change_status');

	/***********Admin Job Category start from here**********/
	Route::get('jobcategories','Admin\AdminUserController@jobcategories')->name($MANAGER_PREFIX.'.jobcategories');
	Route::post('jobcategories','Admin\AdminUserController@saveUpdatejobcategories')->name($MANAGER_PREFIX.'.jobcategories.submit');
	Route::get('get_jobcategories','Admin\AdminUserController@get_jobcategories')->name($MANAGER_PREFIX.'.get_jobcategories');
	Route::get('get_jobcategory_details','Admin\AdminUserController@get_jobcategory_details')->name($MANAGER_PREFIX.'.get_jobcategory_details');
	/***********Admin Job Category ends here**********/
	/***********Admin Job subCategory start from here**********/
	Route::get('jobsubcategories','Admin\AdminUserController@jobsubcategories')->name($MANAGER_PREFIX.'.jobsubcategories');
	Route::post('jobsubcategories','Admin\AdminUserController@saveUpdatejobsubcategories')->name($MANAGER_PREFIX.'.jobsubcategories.submit');
	Route::get('get_jobsubcategories','Admin\AdminUserController@get_jobsubcategories')->name($MANAGER_PREFIX.'.get_jobsubcategories');
	Route::get('get_jobsubcategory_details','Admin\AdminUserController@get_jobsubcategory_details')->name($MANAGER_PREFIX.'.get_jobsubcategory_details');
	/***********Admin Job subCategory ends here**********/
	/***********Admin Company Manager********************/
	Route::get('companies','Admin\AdminUserController@companies')->name($MANAGER_PREFIX.'.companies');

/********************Admin SideBar Setting *********************************/
	Route::get('parent','Admin\AdminUserController@parent')->name($MANAGER_PREFIX.'.parent');

	Route::get('child','Admin\AdminUserController@child')->name($MANAGER_PREFIX.'.child');

	Route::post('child_status','Admin\AdminUserController@child_status')->name($MANAGER_PREFIX.'.child_status');


Route::post('alertchildrole','Admin\AdminUserController@alertchildrole')->name($MANAGER_PREFIX.'.alertchildrole');

Route::post('gEtEmpLoYeRolE','Admin\AdminUserController@gEtEmpLoYeRolE')->name($MANAGER_PREFIX.'.gEtEmpLoYeRolE');
	

	Route::get('userrole','Admin\AdminUserController@userrole')->name($MANAGER_PREFIX.'.userrole');

	Route::post('edit_parent','Admin\AdminUserController@edit_parent')->name('edit_parent.submit');

	Route::post('edit_child','Admin\AdminUserController@edit_child')->name('edit_child.submit');

	Route::post('edit_rolealert','Admin\AdminUserController@edit_rolealert')->name('edit_rolealert.submit');




	Route::post('getParentMenu','Admin\AdminUserController@getParentMenu')->name('getParentMenu');

	Route::post('getChildMenu','Admin\AdminUserController@getChildMenu')->name('getChildMenu');
	Route::post('GetDetails','Admin\AdminUserController@GetDetails')->name('GetDetails');

/********************Admin End Setting *********************************/


	Route::get('add_edit_company','Admin\AdminUserController@add_edit_company')->name($MANAGER_PREFIX.'.add_edit_company');
	Route::get('edit_company/{id}','Admin\AdminUserController@edit_company')->name($MANAGER_PREFIX.'.edit_company');
	Route::post('add_edit_company','Admin\AdminUserController@save_update_company')->name($MANAGER_PREFIX.'.add_edit_company.submit');
	Route::post('markas','Admin\AdminUserController@markas')->name($MANAGER_PREFIX.'.markas');
	/***********Admin Company Manager********************/
 

	/***********Admin Employer Manager********************/
	Route::get('employers','Admin\AdminUserController@employers')->name($MANAGER_PREFIX.'.employers');


	Route::get('add_edit_employers','Admin\AdminUserController@add_edit_employers')->name($MANAGER_PREFIX.'.add_edit_employers');


	Route::post('add_edit_subadmin','Admin\AdminUserController@add_edit_subadmin')->name($MANAGER_PREFIX.'.add_edit_subadmin.submit');






	Route::get('editemployer/{id}','Admin\AdminUserController@editemployer')->name($MANAGER_PREFIX.'.editemployer');
	Route::post('add_edit_employers','Admin\AdminUserController@save_update_employers')->name($MANAGER_PREFIX.'.add_edit_employers.submit');
	Route::get('get_employers','Admin\AdminUserController@get_employers')->name($MANAGER_PREFIX.'.get_employers');

	Route::get('checkemail','Admin\AdminUserController@checkemail')->name($MANAGER_PREFIX.'.checkemail');

	Route::get('checkemailadmin','Admin\AdminUserController@checkemailadmin')->name($MANAGER_PREFIX.'.checkemailadmin');
	
	Route::get('employer_profile/{id}','Admin\AdminUserController@employer_profile');


	Route::match(['get','post'],'jobseekers','Admin\AdminUserController@jobseekers')->name('jobseekers');


	Route::match(['get','post'],'moderators','Admin\AdminUserController@moderators')->name('moderators');

	Route::get('add_jobseeker','Admin\AdminUserController@add_jobseeker')->name('add_jobseeker');
	Route::get('sub_admin','Admin\AdminUserController@sub_admin')->name('sub_admin');


	Route::post('add_edit_jobseeker','Admin\AdminUserController@save_update_jobseeker')->name('add_edit_jobseeker.submit');
	Route::get('editjobseeker/{id}','Admin\AdminUserController@editjobseeker')->name($MANAGER_PREFIX.'.editjobseeker');
	/***********Admin Employer Manager********************/
	/**********Package management starts here************/
	Route::get('packages','Admin\PackageController@packages')->name('packages');
	Route::post('add_edit_packages','Admin\PackageController@add_edit_packages')->name('add_edit_packages.submit');
	Route::get('get_package_details','Admin\PackageController@get_package_details')->name('get_package_details');

	Route::post('DeletePackadge','Admin\PackageController@DeletePackadge')->name('DeletePackadge');




	/**********Package management ends here************/
	/**********Job management starts here************/
	Route::get('jobs','Admin\JobController@job_listing')->name('job_listing');
	Route::get('getadminjobs','Admin\JobController@getadminjobs')->name('getadminjobs');
	Route::post('change_job_status','Admin\JobController@change_job_status')->name('change_job_status');
	Route::get('edit_user_job/{id}','Admin\JobController@edit_user_job')->name('edit_user_job');
	Route::post('update_job','Admin\JobController@update_job')->name('edit_user_job.submit');
	Route::get('add_user_job','Admin\JobController@add_user_job')->name('add_user_job');
	Route::post('save_user_job','Admin\JobController@save_user_job')->name('save_user_job.submit');
	Route::get('managejobapplication/{id}','Admin\AdminUserController@managejobapplication')->name('managejobapplication');
	/**********Job management ends here************/


	/***********Admin Cms pages Routes starts here**********/
	Route::get('pages','AdminController@pages')->name($MANAGER_PREFIX.'.pages');
	Route::post('pages','AdminController@saveUpdatePages')->name($MANAGER_PREFIX.'.pages.submit');
	Route::get('get_pages','AdminController@get_pages')->name($MANAGER_PREFIX.'.get_pages');
	Route::get('get_page_details','AdminController@get_page_details')->name($MANAGER_PREFIX.'.get_page_details');
	/***********Admin Cms pages Routes ends here**********/
	/***********Admin advertisments Routes starts here**********/
	Route::get('advertisments','AdminController@advertisments')->name($MANAGER_PREFIX.'.advertisments');
	Route::post('advertisments','AdminController@saveUpdateadvertisments')->name($MANAGER_PREFIX.'.advertisments.submit');
	Route::get('get_advertisments','AdminController@get_advertisments')->name($MANAGER_PREFIX.'.get_advertisments');
	Route::get('get_advertisments_details','AdminController@get_advertisments_details')->name($MANAGER_PREFIX.'.get_advertisments_details');

	Route::get('markfeature','Admin\AdminUserController@markfeature')->name($MANAGER_PREFIX.'.markfeature');
	/***********Admin advertisments Routes ends here**********/
	Route::post('importusingexcel','Admin\AdminUserController@importusingexcel')->name('manager.importusingexcel');
});

Route::get('fetchCompanies','frontend\Home@fetchCompanies');
Route::get('fetchquestionnaire','frontend\Home@fetchquestionnaire')->name('fetchquestionnaire');
Route::get('fetchusersofcompany','frontend\Home@fetchusersofcompany')->name('fetchusersofcompany');

Route::get('checkAuthentication','frontend\Home@checkAuthentication');
/**//////////////////////////////////////**/
/*******Admin Routes Ends here******/
/**//////////////////////////////////////**/
/**//////////////////////////////////////**/
/*******Employer Routes starts here******/
/**//////////////////////////////////////**/
/**//////////////////////////////////////**/
Route::post('register_employer','frontend\Home@register_employer');
Route::get('verifyUser/{id}','frontend\Home@verifyUser');
Route::group(['prefix' => $EMPLOYER_PREFIX], function() use($MANAGER_PREFIX) {
	Route::get('home','frontend\Employer@index')->name('employer_home');
	Route::get('user/{slug}','frontend\Home@employerprofile');
	Route::match(['get','post'],'edit_employer','frontend\Employer@edit_employer');
	
	/***************Edit company Profile*************/
	Route::get('edit_organization','frontend\Employer@edit_organization')->name('edit_organization');
	Route::post('update_organization','frontend\Employer@update_organization')->name('update_organization');
	/***************Edit company Profile*************/
	/***************Post Job************************/
	Route::get('post_new_job','frontend\Employer@post_new_job')->name('post_new_job');
	Route::post('save_job','frontend\Employer@save_job')->name('save_job.submit');
	Route::post('update_job','frontend\Employer@update_job')->name('update_job.submit');
	Route::get('jobpost_success/{id}','frontend\Employer@jobpost_success')->name('jobpost_success');
	Route::get('editjob/{id}','frontend\Employer@editjob');
	/***************Post Job************************/
	/*******************fetch setting items**************/
	/***********get subcategories on category change********/
	Route::get('fetch_subcategories','frontend\Home@fetchsubcats')->name('fetchsubcats');
	Route::get('fetchcitiesforjob','frontend\Home@fetchcitiesforjob')->name('fetchcitiesforjob');
	/***********get subcategories on category change********/
	/***********get states of country**************/
	Route::get('fetchstates','frontend\Home@fetchstates')->name('fetchstates');
	Route::get('fetchcities','frontend\Home@fetchcities')->name('fetchcities');
	Route::get('questionnaire','frontend\Employer@questionnaire')->name('questionnaire');
	Route::get('add_questionnaire','frontend\Employer@add_questionnaire')->name('add_questionnaire');
	Route::get('edit_questionnaire/{id}','frontend\Employer@edit_questionnaire')->name('edit_questionnaire');
	Route::post('add_questionnaire','frontend\Employer@add_questionnaire')->name('add_questionnaire.submit');
	Route::get('questions/{id}','frontend\Employer@questions')->name('questions');
	Route::get('addquestions/{id}/{id2}','frontend\Employer@addquestions')->name('addquestions');
	Route::post('addnewquestion/{id}','frontend\Employer@addnewquestion')->name('addnewquestion');
	Route::get('deletequestions/{id}/{id2}','frontend\Employer@deletequestions')->name('deletequestions');
	Route::get('deletequestionnaire/{id}','frontend\Employer@deletequestionnaire')->name('deletequestionnaire');
	Route::get('myInterview','frontend\Employer@myInterview')->name('myInterview');
	Route::get('cancelInterview/{id}','frontend\Employer@cancelInterview')->name('cancelInterview');
	/***********get states of country**************/
	Route::get('manage_jobs','frontend\Employer@manage_jobs')->name('manage_jobs');
	Route::get('fetchjobsofuser','frontend\Employer@fetchjobsofuser')->name('fetchjobsofuser');
	Route::get('change_status','frontend\Employer@change_status')->name('change_status');
	Route::get('manage_application/{id}','frontend\Employer@manage_application')->name('manage_application');
	Route::get('fetchapplicationsofjob','frontend\Employer@fetchapplicationsofjob');
	Route::post('updateApplicationStatus','frontend\Employer@updateApplicationStatus');
	Route::get('candidate_profile/{id}/{id2}','frontend\Employer@candidate_profile');
	/*******************fetch setting items**************/
	/******************Interview venue********************/
	Route::get('venues','frontend\Employer@venues')->name('venues');
	Route::get('add_venues','frontend\Employer@add_venues')->name('add_venues');
	Route::get('edit_venue/{id}','frontend\Employer@edit_venue')->name('edit_venue');
	Route::get('change_status_of_venue/{id}/{id2}','frontend\Employer@change_status_of_venue')->name('change_status_of_venue');
	Route::post('add_venues','frontend\Employer@save_venues')->name('add_venues.submit');
	Route::get('fetchvenuelist','frontend\Employer@fetchvenuelist')->name('fetchvenuelist');
	
	/******************Interview venue********************/
	/******************Schedule interview*****************/
	Route::post('scheduleInterview','frontend\Employer@scheduleInterview')->name('scheduleInterview');
	Route::post('sendMessage','frontend\Employer@sendMessage')->name('sendMessage');
	/******************Schedule interview*****************/
	/******************Packages**************************/
	Route::get('packages','frontend\Employer@packages')->name('packagepricing');

	Route::get('payments','frontend\Employer@payments')->name('payments');
	/******************Packages**************************/
});

/*******Employer Routes Ends here******/
/**//////////////////////////////////////**/
/**//////////////////////////////////////**/
/*******Candidate Routes starts here******/
/**//////////////////////////////////////**/
Route::group(['prefix' => $CANDIDATE_PREFIX], function() use($CANDIDATE_PREFIX) {
	Route::post('register_candidate','frontend\Home@register_candidate')->name('register_candidate');
});
/*********Candidate home route********/
Route::get('getjobseekerdetails','frontend\Jobseeker@getjobseekerdetails');
Route::get('getcountrieslist','frontend\Jobseeker@getcountrieslist');
Route::get('getindustrylist','frontend\Jobseeker@getindustrylist');
Route::get('getfunctionalarealist','frontend\Jobseeker@getfunctionalarealist');
Route::post('updatePersonalinfo','frontend\Jobseeker@updatePersonalinfo');
Route::post('addneweducation','frontend\Jobseeker@addneweducation');
Route::get('geteducationdetails','frontend\Jobseeker@geteducationdetails');
Route::post('updateEducationalInfo','frontend\Jobseeker@updateEducationalInfo');
Route::post('removeEducationalInfo','frontend\Jobseeker@removeEducationalInfo');
Route::post('add_professional_details','frontend\Jobseeker@add_professional_details');
Route::post('update_professional_details','frontend\Jobseeker@update_professional_details');
Route::get('getprofessionaldetails','frontend\Jobseeker@getprofessionaldetails');
Route::post('removeProfessionalInfo','frontend\Jobseeker@removeProfessionalInfo');
/*****Certification Details***/
Route::post('add_certification_details','frontend\Jobseeker@add_certification_details');
Route::post('update_certification_details','frontend\Jobseeker@update_certification_details');
Route::get('getcertificationdetails','frontend\Jobseeker@getcertificationdetails');
Route::post('removeCertificationInfo','frontend\Jobseeker@removeCertificationInfo');

/*****Certification Details***/
/*********Skill Details******/
Route::post('add_skill_details','frontend\Jobseeker@add_skill_details');
Route::get('getskilldetails','frontend\Jobseeker@getskilldetails');
Route::post('removeskillInfo','frontend\Jobseeker@removeskillInfo');
/*********Skill Details******/
/**********Resume***********/
Route::post('add_resume','frontend\Jobseeker@add_resume');
Route::get('getresumedetails','frontend\Jobseeker@fetchresumedetails');
Route::get('getUsersResumeDetails','frontend\Jobseeker@getUsersResumeDetails');
Route::get('getjobs','frontend\Jobseeker@getjobs');
Route::get('getjobdetail','frontend\Jobseeker@getjobdetail');
/**********Resume***********/
/**********Save Job**********/
Route::post('savejob','frontend\Jobseeker@savejob');
Route::post('applyjob','frontend\Jobseeker@applyjob');
Route::get('getjobseekerdashboard','frontend\Jobseeker@getjobseekerdashboard');
Route::get('getsavedjobs','frontend\Jobseeker@getsavedjobs');
Route::get('getapplyjobsdetails','frontend\Jobseeker@getapplyjobsdetails');
Route::get('getjobquestionnaire','frontend\Jobseeker@getjobquestionnaire');
Route::post('submitanswers','frontend\Jobseeker@submitanswers');
Route::get('gethomepagejobs','frontend\Home@gethomepagejobs');
Route::post('sendresetpasswordmail','frontend\Home@sendresetpasswordmail');
Route::post('updatepassword','frontend\Home@updatepassword');
Route::get('getcompanydetails','frontend\Home@getcompanydetails');

/**********Save Job**********/
Route::get('/{any}','frontend\Home@home')->where('any','.*');

/**//////////////////////////////////////**/
/*******Candidate Routes ends here******/
/**//////////////////////////////////////**/

