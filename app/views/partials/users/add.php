
<template id="usersAdd">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Add New Users</h4> <hr class='d-block d-sm-none' /></div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div  class="pb-2 mb-3 border-bottom">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-md-7 comp-grid" :class="setGridSize">
                        
                        <div  class=" animated fadeIn">
                            <b-alert  class="animated bounce" :show="showError" variant="danger" dismissible @dismissed="showError=false">
                            <i class="material-icons">error</i> {{errorMsg}}
                            </b-alert>
                            
                            
                            <form enctype="multipart/form-data" @submit="save" class="form form-default" action="users/add" method="post">
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('user_name')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="user_name">User Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.user_name"
                                                v-validate="'required:true'"
                                                data-vv-as="User Name"
                                                class="form-control "
                                                type="text"
                                                name="user_name"
                                                placeholder="Enter User Name"
                                                
                                                />
                                                <small v-show="errors.has('user_name')" class="form-text text-danger">
                                                    {{ errors.first('user_name') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('first_name')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="first_name">First Name </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.first_name"
                                                v-validate="''"
                                                data-vv-as="First Name"
                                                class="form-control "
                                                type="text"
                                                name="first_name"
                                                placeholder="Enter First Name"
                                                
                                                />
                                                <small v-show="errors.has('first_name')" class="form-text text-danger">
                                                    {{ errors.first('first_name') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('last_name')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="last_name">Last Name </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.last_name"
                                                v-validate="''"
                                                data-vv-as="Last Name"
                                                class="form-control "
                                                type="text"
                                                name="last_name"
                                                placeholder="Enter Last Name"
                                                
                                                />
                                                <small v-show="errors.has('last_name')" class="form-text text-danger">
                                                    {{ errors.first('last_name') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('password')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.password"
                                                v-validate="'required:true|max:255'"
                                                data-vv-as="Password"
                                                class="form-control "
                                                type="password"
                                                name="password"
                                                placeholder="Enter Password"
                                                
                                                />
                                                <small v-show="errors.has('password')" class="form-text text-danger">
                                                    {{ errors.first('password') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('confirm_password')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input
                                                v-model="data.confirm_password"
                                                v-validate="'required:true|confirmed:password'"
                                                data-vv-as="Confirm Password"
                                                class="form-control "
                                                type="password"
                                                name="confirm_password"
                                                placeholder="Confirm Password"
                                                
                                                />
                                                <small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('email')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="email">Email </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.email"
                                                v-validate="'email'"
                                                data-vv-as="Email"
                                                class="form-control "
                                                type="email"
                                                name="email"
                                                placeholder="Enter Email"
                                                
                                                />
                                                <small v-show="errors.has('email')" class="form-text text-danger">
                                                    {{ errors.first('email') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('picture')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="picture">Picture </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <niceupload
                                                    fieldname="picture"
                                                    
                                                    control-class="upload-control"
                                                    
                                                    dropmsg="Drop files here to upload"
                                                    uploadpath="uploads/files/"
                                                    filenameformat="random" 
                                                    extensions="jpg , png , gif , jpeg"  :filesize="3" :maximum="1" 
                                                    @uploadcompleted="uploadcompleted"
                                                    name="picture"
                                                    v-model="data.picture"
                                                    v-validate="''"
                                                    data-vv-as="Picture"
                                                    >
                                                    
                                                </niceupload>
                                                <small v-show="errors.has('picture')" class="form-text text-danger">{{ errors.first('picture') }}</small>
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('user_role')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="user_role">User Role <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                
                                                <dataselect
                                                    v-model="data.user_role"
                                                    data-vv-value-path="data.user_role"
                                                    data-vv-as="User Role"
                                                    v-validate="'required:true'"
                                                    placeholder="Select A Value ... " name="user_role" :multiple="false" 
                                                    :datasource="user_roleOptionList"
                                                    
                                                    >
                                                </dataselect>
                                                <small v-show="errors.has('user_role')" class="form-text text-danger">{{ errors.first('user_role') }}</small>
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <div class="form-group text-center">
                                    <button class="btn btn-primary"  :disabled="errors.any()" type="submit">
                                        <i class="load-indicator">
                                            <clip-loader :loading="saving" color="#fff" size="20px"></clip-loader>
                                        </i>
                                        {{submitbuttontext}}
                                        <i class="material-icons">send</i>
                                    </button>
                                </div>
                                
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
</template>

<script>
    
    var UsersAddComponent = Vue.component('usersAdd', {
    template : '#usersAdd',
    mixins: [AddPageMixin],
    props:{
    pagename : {
    type : String,
    default : 'users',
    },
    apipath : {
    type : String,
    default : 'users/add',
    },
    submitbuttontext : {
    type : String,
    default : 'Submit',
    },
    msgaftersave : {
    type : String,
    default : 'New Record Added Successfully',
    },
    },
    data : function() {
    return {
    data : {
    user_name: '',first_name: '',last_name: '',password: '',confirm_password: '',email: '',picture: '',user_role: '',
    },
    
    user_roleOptionList: [{"label":"User","value":"User"}],
    }
    },
    computed: {
    pageTitle: function(){
    return 'Add New Users';
    },
    },
    watch: {
    modelBind: function(){
    var binds = this.modelBind;
    for(key in binds){
    this.data[key]= binds[key];
    }
    },
    '$route': function(route){
    if(route.name == 'usersadd' ){
    this.SetPageTitle( this.pageTitle );
    }
    },
    },
    methods : {
    save : function(e){
    //prevent default event
    e.preventDefault();
    var self = this;
    var submitAction = self.submitAction;
    this.$validator.validateAll().then( function(result) {
    if (result) {
    var payload = self.data;
    var url = setApiUrl(self.apipath);
    if(submitAction == 'submit'){
    self.saving = true;
    self.$http.post( url , payload , {emulateJSON:true} ).then(function (response) {
    self.saving = false
    self.$root.$emit('requestCompleted' , self.msgaftersave);
    self.resetForm();
    self.$router.push('/users');
    },
    function (response) {
    self.saving = false;
    self.errorMsg = response.statusText;
    self.showError = true;
    });
    }
    else{
    bus.$emit('movewizard' , [payload, url, submitAction]);
    }
    self.errors.clear();
    }
    });
    return;
    },
    
    resetForm : function(){
    this.data = {user_name: '',first_name: '',last_name: '',password: '',confirm_password: '',email: '',picture: '',user_role: '',};
    this.$validator.reset();
    },
    uploadcompleted : function(arg){
    this.data[arg.field]= arg.result;
    },
    },
    created: function(){
    
    },
    mounted : function() {
    
    },
    });
    
</script>

<style>
    <!--  Component Style Goes Here -->
</style>
