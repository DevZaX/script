@extends("master")

@section("content")

<div id="app" style="margin-top: 240px" v-cloak>
    <div class="row justify-content-md-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <p>Sign in with credentials</p>
                </div>
                <div class="card-body">
                     <p v-show="message" style="color: red;">@{{ message }}</p>
                    <form>
                        <input type="text" class="form-control" placeholder="email" v-model="email">
                        <hr style="border: 0">
                        <input type="password" class="form-control" placeholder="password" v-model="password">
                        <hr style="border: 0">
                        <button type="button" class="btn btn-primary" @click="login">Login</button>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>

@endsection

@section("js")
    <script src="/js/users.js"></script>
@endsection