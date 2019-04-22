/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/
/*require('./bootstrap');
window.Vue = require('vue');
*/
/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/
/*Vue.component('example-component', require('./components/ExampleComponent.vue'));
const app = new Vue({
el: '#app'
});*/
import Vue from 'vue'
import axios from 'axios'
import VeeValidate from 'vee-validate';
import VueRouter from 'vue-router'
import VueFlashMessage from 'vue-flash-message';
import VueSession from 'vue-session'
import Datepicker from 'vuejs-datepicker';
import VueMoment from 'vue-moment'
import VTooltip from 'v-tooltip'
import vSelect from 'vue-select'
import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyBnQrXrRyWtQu7EKB9Hk1S10Gc6eQuamUo",
    libraries: "places" // necessary for places input
  }
});

// import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
 import TimeRange from 'vue-time-range';
/*import Buefy from 'buefy';
import 'buefy/lib/buefy.min.css';*/
  // import VueCkeditor from 'vue-ckeditor5'
  /* const options2 = {
  editors: {
    classic: ClassicEditor,
  },
  name: 'ckeditor'
}*/
//Vue.use(VueCkeditor.plugin, options2);
Vue.component('v-select', vSelect)
Vue.use(require('vue-moment'));
Vue.use(VTooltip);
//Vue.use(Vuex);
//Vue.use(Buefy);
//Vue.use(VueCkeditor.plugin, options);
/*import 'vue-loaders/dist/vue-loaders.css';
import * as VueLoaders from 'vue-loaders';
*/

window.Vue = require('vue');
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
//Vue.use(VeeValidate);
Vue.use(VueRouter)
Vue.use(VeeValidate)
Vue.use(VueFlashMessage);
//Vue.use(VueLoaders);
var options = {
    persist: true
}
Vue.use(VueSession,options)
Vue.use(Datepicker)
Vue.component('data-component', require('./components/Employer/DataComponent.vue'));
Vue.component('application-component', require('./components/Employer/ApplicationComponent.vue'));
Vue.component('jobseekerprofile-component', require('./components/Employer/JobseekerProfile.vue'));
Vue.component('profile-joblisting', require('./components/Employer/profilejoblisting.vue'));
/*Vue.use(Auth);*/
Vue.component('pagination', require('laravel-vue-pagination'));
require('vue-flash-message/dist/vue-flash-message.min.css');
//Vue.use(axios)
//Vue.http.headers.common['Authorization'] = 'Bearer '+Vue.auth.getToken();
Vue.component('webheader',require('./components/Navbar.vue'));
Vue.component('webheaderprofile',require('./components/NavbarProfile.vue'));
Vue.component('webfooter',require('./components/Footer.vue'));
import Home from './views/Home'
import Login from './views/Login'

import Registration from './views/Registration'
import CandidateRegistration from './views/CandidateRegistration'
import CandidateDashboard from './views/Jobseeker/Dashboard'
import PersonalDetails from './views/Jobseeker/PersonalDetails'
import EducationalDetails from './views/Jobseeker/EducationalDetails'
import ProfessionalDetails from './views/Jobseeker/ProfessionalDetails'
import CertificationDetails from './views/Jobseeker/CertificationDetails'
import SkillsDetails from './views/Jobseeker/SkillsDetails'
import Resume from './views/Jobseeker/Resume'
import Profile from './views/Jobseeker/Profile'
import Jobs from './views/Jobseeker/Jobs'
import JobDetail from './views/Jobseeker/JobDetails'
import SavedJobs from './views/Jobseeker/SavedJobs'
import ApplyJobs from './views/Jobseeker/ApplyJobs'
import SubmitQuestionnaire from './views/Jobseeker/SubmitQuestionnaire'
import JobApplySuccess from './views/Jobseeker/JobApplySuccess'
import PublicProfile from './views/Jobseeker/PublicProfile'
import ForgotPass from './views/ForgotPass'
import ChangePassword from './views/ChangePassword'
import CompanyDetails from './views/CompanyDetails'
//import Welcome from './views/Welcome'
const router = new VueRouter({
mode: 'history',
routes: [
{path: '/',name: 'home',component: Home,},
{path: '/userlogin',name: 'userlogin',component: Login,meta:{forVisitors:true}},
{path: '/registration',name: 'registration',component: Registration},
{path: '/candidate_registration',name: 'candidate_registration',component: CandidateRegistration},
/**************Candidate starts here****************/
/**************Candidate Dashboard****************/
{path: '/user_dashboard',name: 'user_dashboard',component: CandidateDashboard,meta:{forAuth:true}},
{path:'/user_profile/personalinfo',name:'user_profile/personalinfo',component:PersonalDetails,meta:{forAuth:true}},
{path:'/user_profile/educationaldetails',name:'user_profile/educationaldetails',component:EducationalDetails,meta:{forAuth:true}},
{path:'/user_profile/professionaldetails',name:'user_profile/professionaldetails',component:ProfessionalDetails,meta:{forAuth:true}},
{path:'/user_profile/certificationdetails',name:'user_profile/certificationdetails',component:CertificationDetails,meta:{forAuth:true}},
{path:'/user_profile/skillsdetails',name:'user_profile/skillsdetails',component:SkillsDetails,meta:{forAuth:true}},
{path:'/user_profile/resume',name:'user_profile/resume',component:Resume,meta:{forAuth:true}},
{path:'/profile',name:'profile',component:Profile,meta:{forAuth:true}},
{path:'/jobs',name:'jobs',component:Jobs,meta:{forAuth:true}},
{path:'/jobdetails/:id',name:'jobdetails',component:JobDetail},
{path:'/savedjobs',name:'savedjobs',component:SavedJobs},
{path:'/apply/:id',name:'apply',component:ApplyJobs},
{path:'/userprofile/:id',name:'userprofile',component:PublicProfile},
{path:'/submitquestionnaire/:id',name:'submitquestionnaire',component:SubmitQuestionnaire},
{path:'/jobapplysuccess',name:'jobapplysuccess',component:JobApplySuccess},
{path:'/forgotpass',name:'forgotpass',component:ForgotPass},
{path:'/cahngepassword/:id',name:'cahngepassword',component:ChangePassword},
{path:'/companies/:id',name:'companies',component:CompanyDetails},


/**************Candidate Dashboard****************/
/**************Candidate ends here****************/

],
});/*
router.beforeEach(
	(to,from,next)=>
	{
		if(to.matched.some(record=>record.meta.forVisitors))
		{
			if(!this.$session.exists())
			{
				next()
			}else {
				next({
					name:'user_dashboard'
				})
			}
		}
		else if(to.matched.some(record=>record.meta.forAuth))
		{
			if(!this.$session.exists())
			{
				next({
					name:'userlogin'
				})
			}else next()
		}else next()
	}
)*/

const app = new Vue({
el: '#app',
components: { Home,Datepicker },
router,
});