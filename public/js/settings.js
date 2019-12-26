var app = new Vue({
	el : "#app",
	data : {
		message : "",
		error : "",
		editPassword : false,
		user:{},
	},
	methods : {
		update()
		{
			this.error = "";
			this.message = "";
			axios.post("/update",this.user)
			.then((res)=>{
				this.showSuccessMessage("Success");
			})
			.catch((err)=>{
				this.showErrorMessage(err);
			})
		},
		showSuccessMessage(msg)
		{
			this.message = msg;
			setTimeout(()=>{
				this.message = "";
			},1000);
		},
		showErrorMessage(err)
		{
			if(err.response.data.errors) this.error = err.response.data.errors;
			if(err.response.data.message) this.message = err.response.data.message;
		},
		toggleEditPassword()
		{
			if(this.editPassword)
			{
				this.editPassword = false;
				delete this.user.password;
			}
			else
			{
				this.editPassword = true;
				this.user.password = "";
			}
		}
	}
});