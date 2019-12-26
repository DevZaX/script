var app = new Vue({
	el : "#app",
	data : {
		message:"",
		accounts:[],
		regions:[
		"us-east-2",
		"us-east-1",
		"us-west-1",
		"us-west-2",
		"ap-east-1",
		"ap-south-1",
		"ap-northeast-3",
		"ap-northeast-2",
		"ap-southeast-1",
		"ap-southeast-2",
		"ap-northeast-1",
		"ca-central-1",
		"eu-central-1",
		"eu-west-1",
		"eu-west-2",
		"eu-west-3",
		"eu-north-1",
		"me-south-1",
		"sa-east-1",
		],
		selectedAccount:null,
		selectedRegion:null,
		instancesId:[],
		data:[],
		btnTxt:"Start",
	},
	methods : {
		fillErrors(err){
			if(err.response.data.message) this.message = err.response.data.message;
		},
		DescribeInstances()
		{
			this.instancesId = [];
			this.message = "";
			axios.post("/DescribeInstances",{
				key:this.selectedAccount.key,
				secret:this.selectedAccount.secret,
				token:this.selectedAccount.token,
				region:this.selectedRegion
			})
			.then((res)=>{
				this.instancesId = res.data;
			})
			.catch((err)=>{
				this.fillErrors(err);
			})
		},
		setData(id)
		{
			var item = this.data.find((item)=>(
				item.account.name == this.selectedAccount.name && item.region == this.selectedRegion
			));

			if(item!=null)
			{
				var test = this.data.find((item)=>(item.ids.includes(id)));
				if(test) return;
				item.ids.push(id);
			}
			else
			{
				
				var item = {};
				item.ids = [];
				item.ids.push(id);
				item.account = this.selectedAccount;
				item.region = this.selectedRegion;

				this.data.push(item);
			}

			console.log(this.data);
		},
		removeItem(item)
		{
			this.data = this.data.filter((item)=>(
	item.id != item.id && item.region != item.region && item.account.name!=item.account.name
			))
		},
		start()
	{
		this.btnTxt = "Wait";
		axios.post("/start",{data:this.data})
		.then((res)=>{
			this.btnTxt = "Done";
		})
		.catch((err)=>{
			this.fillErrors(err);
		})
	},
	getAccounts()
	{
		axios.get("/getAccounts")
		.then((res)=>{
			this.accounts = res.data;
		})
		.catch((err)=>{
			this.fillErrors(err);
		})
	},
	selectAllInstances()
	{
		this.instancesId.forEach((instanceId)=>{
			this.setData(instanceId);
		})
	}
	},
	
	created()
	{
		this.getAccounts();
	}
});