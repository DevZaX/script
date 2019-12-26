@extends("master")

@section("content")

<div id="app" v-cloak>
    @include("nav")
    <p style="margin-left: 16px">@{{message}}</p>
    <p style="color: red;margin-left: 16px " v-if="error.name && error.name.length>0">@{{error.name[0]}}</p>
    <p style="color: red;margin-left: 16px" v-if="error.key && error.key.length>0">@{{error.key[0]}}</p>
    <p style="color: red;margin-left: 16px" v-if="error.secret && error.secret.length>0">@{{error.secret[0]}}</p>
    <hr style="border: 0">
    <div class="row container" style="margin-top: 16px">
        <div class="col-6">
            <div v-if="canEditAccount">
                <p>Edit Account</p>
                <button @click="updateAccount" class="btn btn-success">
                    Save
                </button>
                <button @click="deleteAccount" class="btn btn-danger">
                    Delete
                </button>
                <button @click="cancelAccount"  class="btn btn-primary">
                    Cancel
                </button>
                 <div class="form-group">
                    <label>Account name:</label>
                    <input type="text" v-model="accountToUpdate.name" class="form-control">
                </div>
                 <div class="form-group">
                    <label>Account key:</label>
                    <input type="text" v-model="accountToUpdate.key" class="form-control">
                </div>
                 <div class="form-group">
                    <label>Account secret:</label>
                    <input type="text" v-model="accountToUpdate.secret" class="form-control">
                </div>
                 <div class="form-group">
                    <label>Account token:</label>
                    <input type="text" v-model="accountToUpdate.token" class="form-control">
                </div>
            </div>
            <div v-if="!canEditAccount">
            <div class="form-group">
                <label>Account name:</label>
                <input type="text" v-model="accountToSave.name" class="form-control">
            </div>
             <div class="form-group">
                <label>Account key:</label>
                <input type="text" v-model="accountToSave.key" class="form-control">
            </div>
             <div class="form-group">
                <label>Account secret:</label>
                <input type="text" v-model="accountToSave.secret" class="form-control">
            </div>
             <div class="form-group">
                <label>Account token:</label>
                <input type="text" v-model="accountToSave.token" class="form-control">
            </div>
            <hr style="border: 0">
            <button class="btn btn-primary" @click="saveAccount">Save account</button>
        </div>
        </div>
        <div class="col-6">
            <p>Accounts</p>
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <th>Name</th>
                    <th>Key</th>
                    <th>Secret</th>
                    <th>Token</th>
                </thead>
                <tbody>
                    <tr style="cursor: pointer;" v-for="account in accounts" @click="editAccount(account)">
                        <td>@{{ account.name }}</td>
                        <td>@{{account.key}}</td>
                        <td>@{{account.secret}}</td>
                        <td>@{{account.token}}</td>
                    </tr>
                    <tr v-if="accounts.length==0">
                        <td colspan="4">
                            No Accounts found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section("js")
    <script src="/js/accounts.js"></script>
@endsection