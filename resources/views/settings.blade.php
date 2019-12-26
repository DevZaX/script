@extends("master")

@section("content")

<div id="app" v-cloak>
    @include("nav")
    <p style="margin-left: 16px">@{{message}}</p>
    <p style="color: red;margin-left: 16px " v-if="error.email && error.email.length>0">@{{error.email[0]}}</p>
    <p style="color: red;margin-left: 16px" v-if="error.password && error.password.length>0">@{{error.password[0]}}</p>
    <hr style="border: 0">
    <div class=" container" style="margin-top: 16px">
    	<div class="form-group">
            <label>New email:</label>
            <input type="text" class="form-control" v-model="user.email">
        </div>
       <button @click="toggleEditPassword" class="btn btn-primary">Edit password</button>
       <hr style="border: 0">
       <div v-show="editPassword">
            <div class="form-group">
                <label>New password</label>
                <input type="password" v-model="user.password" class="form-control">
            </div>
             <div class="form-group">
                <label>Confirm password</label>
                <input type="password" v-model="user.password_confirmation" class="form-control">
            </div>
       </div>
       <hr style="border: 0">
       <button class="btn btn-success" @click="update">Update</button>
    </div>
</div>

@endsection

@section("js")
	<script src="/js/settings.js"></script>
@endsection