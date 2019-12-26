var app = new Vue({
	el : "#app",
	data : {
		email : "",
		password : "",
		error:"",
		message:"",
	},
	methods : {
		login()
		{
			axios.post("login",{
				email:this.email,
				password:this.password
			})
			.then((res)=>{
				location.href = "/";
			})
			.catch((err)=>{
				this.fillErrors(err);
			})
		},
		fillErrors(err){
			if(err.response.data.errors) this.error = err.response.data.errors;
			if(err.response.data.message) this.message = err.response.data.message;
		},
	}
});