var app = new Vue({
	el : "#app",
	data : {
		accountToSave:{},
		message:"",
		accounts:"",
		error:"",
		canEditAccount:false,
		accountToUpdate:{},
	},
	methods:{
		saveAccount()
		{
			axios.post("/saveAccount",this.accountToSave)
			.then((res)=>{
				this.showSuccessMessage("Success");
				this.getAccounts();
				this.accountToSave={};
			})
			.catch((err)=>{
				this.handleErrors(err);
			})
		},
		showSuccessMessage(msg)
		{
			this.message = msg;
			setTimeout(()=>{
				this.message = "";
			},1000);
		},
		getAccounts()
		{
			axios.get("/getAccounts")
			.then((res)=>{
				this.accounts = res.data;
			})
			.catch((err)=>{
				this.handleErrors(err);
			})
		},
		handleErrors(err)
		{
			if(err.response.data.errors) this.error = err.response.data.errors;
			if(err.response.data.message) this.message = err.response.data.message;
		},
		deleteAccount()
		{
			console.log('clicked');
			if(!confirm("confirm please")) return;
			axios.delete("/deleteAccount/"+this.accountToUpdate.id)
			.then((res)=>{
				this.showSuccessMessage("Success");
				this.getAccounts();
				this.canEditAccount=false;
			})
			.catch((err)=>{
				this.handleErrors(err);
			})
		},
		cancelAccount()
		{
			this.canEditAccount = false;
		},
		updateAccount()
		{
			axios.put("/updateAccount/"+this.accountToUpdate.id,this.accountToUpdate)
			.then((res)=>{
				this.showSuccessMessage("Success");
				this.getAccounts();
				this.canEditAccount=false;
				this.accountToUpdate={};
			})
			.catch((err)=>{
				this.handleErrors(err);
			})
		},
		editAccount(account)
		{
			this.accountToUpdate = account;
			this.canEditAccount = true;
		}
	},
	created()
	{
		this.getAccounts();
	}
})