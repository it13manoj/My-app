export default function(Vue){
	Vue.auth=
	{
		setToken(token,fname,lanme,email,contact,id)
		{
			localStorage.setItem('token',token);
			localStorage.setItem('fname',fname);
			localStorage.setItem('lanme',lanme);
			localStorage.setItem('email',email);
			localStorage.setItem('contact',contact);
			localStorage.setItem('id',id);
			//localStorage.setItem('expiration',expiration);
		},
		getToken()
		{
			var token = localStorage.getItem('token');
			var fname =localStorage.getItem('fname');
			if(!token || !fname)
			{
				return null;
			}
			return token;
			/*if(Date.now() > parseInt(expiration))
			{
				this.destroyToken();
				return null;
			}else
			{
				return token;
			}*/
		},
		destroyToken()
		{
			localStorage.removeItem('token');
			localStorage.removeItem('fname');
			localStorage.removeItem('lanme');
			localStorage.removeItem('email');
			localStorage.removeItem('contact');
			localStorage.removeItem('id');
		},
		isAuthenticated()
		{
			if(this.getToken())
			{
				return true;
			}else
			{
				return false;
			}
		}

	}
	Object.defineProperties(Vue.prototype,{
		$auth:{
			get(){
				return Vue.auth;
			}
		}
	})
}