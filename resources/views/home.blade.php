@extends("master")

@section("content")

<div id="app" v-cloak>
    @include("nav")
    <p>@{{message}}</p>
    <hr style="border: 0">
    <div class="row container" style="margin-top: 16px">
    	<div class="col-6">
    		<div class="row">
    			<div class="col-6">
    				<label>Accounts:</label>
    				<select class="form-control" v-model="selectedAccount">
    					<option></option>
    					<option v-for="account in accounts" :value="account">@{{account.name}}</option>
    				</select>
    			</div>
    			<div class="col-6">
    				<label>Regions:</label>
    				<select class="form-control" v-model="selectedRegion" 
    				@change="DescribeInstances">
    					<option></option>
    					<option v-for="region in regions" :value="region">@{{region}}</option>
    				</select>
    			</div>
    		</div>
    		<hr style="border: 0">
            <button @click="selectAllInstances">Select all</button>
            <hr style="border: 0">
    		<p>Instances:</p>
    		<ul>
    			<li  style="cursor: pointer;" v-for="id in instancesId" @click="setData(id)">@{{id}}</li>
    		</ul>
    	</div>
        <div class="col-6" style="margin-top: 16px">
            <table v-if="data.length>0" class="table table-sm table-bordered">
                <thead>
                    <th>Account</th>
                    <th>Region</th>
                    <th>Instance</th>
                </thead>
                <tbody>
                    <tr  v-for="item in data">
                        <td>@{{item.account.name}}</td>
                        <td>@{{item.region}}</td>
                        <td>
                            <ul>
                                <li v-for="id in item.ids">@{{id}}</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr style="border: 0">
            <button v-if="data.length>0" class="btn btn-success" @click="start">@{{btnTxt}}</button>
        </div>
    </div>
</div>

@endsection

@section("js")
	<script src="/js/home.js"></script>
@endsection