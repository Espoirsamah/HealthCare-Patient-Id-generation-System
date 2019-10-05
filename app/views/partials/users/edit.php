
<template id="usersEdit">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Edit Users</h4> <hr class='d-block d-sm-none' /></div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div  class="pb-2 mb-3 border-bottom">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-md-7 comp-grid" :class="setGridSize">
                        
                        <div  class=" animated fadeIn">
                            <b-alert :show="showError" variant="danger"  class="animated bounce" dismissible @dismissed="showError=false">
                            <i class="material-icons">error</i> {{errorMsg}}
                            </b-alert>
                            <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'users/edit/' + data.id" method="post">
                                
                                
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
                                    <button @click="update()" :disabled="errors.any()" class="btn btn-primary" type="button">
                                        <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="20px"></clip-loader> </i>
                                        {{submitbuttontext}}
                                        <i class="material-icons">send</i>
                                    </button>
                                </div>
                            </form>
                            
                            <div v-show="loading" class="load-indicator static-center">
                                <span class="animator">
                                    <clip-loader :loading="loading" color="gray" size="20px">
                                    </clip-loader>
                                </span>
                                <h4 style="color:gray" class="loading-text">Loading...</h4>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
</template>

<script>
    
    var UsersEditComponent = Vue.component('usersEdit', {
    template : '#usersEdit',
    mixins: [EditPageMixin],
    props: {
    pagename : {
    type : String,
    default : 'users',
    },
    apipath : {
    type : String,
    default : 'users/edit',
    },
    submitbuttontext : {
    type : String,
    default : 'Update',
    },
    pageicon : {
    type : String,
    default : '',
    },
    msgafterupdate : {
    type : String,
    default : 'Record Updated Successfully',
    },
    },
    data: function() {
    return {
    data : { user_name: '',first_name: '',last_name: '',picture: '',user_role: '', },
    
    user_roleOptionList: [{"label":"User","value":"User"}],
    }
    },
    computed: {
    pageTitle: function(){
    return 'Edit Users';
    },
    },
    
    methods: {
    load: function(){
    var url = setApiUrl(this.apipath + '/' + this.id);
    this.loading = true;
    this.showError = false;
    this.ready = false;
    this.$http.get( url ).then(
    function (response) {
    this.data = response.body;
    this.loading = false
    this.ready = true
    },
    function (response) {
    this.loading = false;
    this.errorMsg = response.statusText;
    this.showError = true;
    }
    );
    },
    
    update:function(){
    var self = this;
    var submitAction = self.submitAction;
    this.$validator.validateAll().then( function(result) {
    if (result) {
    var payload = self.data;
    var url = setApiUrl(self.apipath + '/' + self.id);
    if(submitAction == 'submit'){
    self.saving = true;
    self.$http.post( url , payload , {emulateJSON:true} ).then(
    function (response) {
    self.saving = false
    self.$root.$emit('requestCompleted' , self.msgafterupdate);
    if(!this.ismodal){
    self.$router.push('/users');
    }
    },
    function (response) {
    self.saving = false;
    self.errorMsg = response.statusText;
    self.showError = true;
    }
    );
    }
    else{
    bus.$emit('movewizard' , [payload, url, submitAction]);
    }
    }
    });
    },
    uploadcompleted : function(arg){
    this.data[arg.field]= arg.result;
    },
    },
    watch: {
    id: function(newVal, oldVal) {
    if(this.id){
    this.load();
    }
    },
    modelBind: function(){
    var binds = this.modelBind;
    for(key in binds){
    this.data[key]= binds[key];
    }
    },
    '$route': function(route){
    if(route.name == 'usersedit' ){
    this.SetPageTitle( this.pageTitle );
    }
    },
    pageTitle: function(){
    this.SetPageTitle( this.pageTitle );
    },
    },
    created: function(){
    this.SetPageTitle(this.pageTitle);
    },
    mounted: function() {
    //this.load();
    },
    });
    
</script>

<style>
    <!--  Component Style Goes Here -->
</style>
