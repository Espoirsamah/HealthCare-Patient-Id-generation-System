
<template id="patientsAdd">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Add New Patients</h4> <hr class='d-block d-sm-none' /></div>
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
                            
                            
                            <form enctype="multipart/form-data" @submit="save" class="form form-default" action="patients/add" method="post">
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('first_name')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.first_name"
                                                v-validate="'required:true'"
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
                                            <label class="control-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.last_name"
                                                v-validate="'required:true'"
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
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('gender')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="gender">Gender <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <dataradio
                                                    v-model="data.gender"
                                                    data-vv-value-path="data.gender"
                                                    data-vv-as="Gender"
                                                    v-validate="'required:true'"
                                                    name="gender" 
                                                    :datasource="genderOptionList"
                                                    
                                                    >
                                                    
                                                </dataradio>
                                                
                                                <small v-show="errors.has('gender')" class="form-text text-danger">{{ errors.first('gender') }}</small>
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('facilitie')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="facilitie">Facilitie <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.facilitie"
                                                v-validate="'required:true'"
                                                data-vv-as="Facilitie"
                                                class="form-control "
                                                type="text"
                                                name="facilitie"
                                                placeholder="Enter Facilitie"
                                                
                                                />
                                                <small v-show="errors.has('facilitie')" class="form-text text-danger">
                                                    {{ errors.first('facilitie') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('doctor_name')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="doctor_name">Doctor Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.doctor_name"
                                                v-validate="'required:true'"
                                                data-vv-as="Doctor Name"
                                                class="form-control "
                                                type="text"
                                                name="doctor_name"
                                                placeholder="Enter Doctor Name"
                                                
                                                />
                                                <small v-show="errors.has('doctor_name')" class="form-text text-danger">
                                                    {{ errors.first('doctor_name') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('registration_date')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="registration_date">Registration Date <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <flat-pickr
                                                v-model="data.registration_date"
                                                v-validate="'required:true'"
                                                data-vv-as="Registration Date"
                                                name="registration_date"
                                                placeholder="Enter Registration Date"
                                                :config="{dateFormat: 'Y-m-d',altFormat: 'F j, Y',altInput: true, allowInput:true}"
                                                >
                                                </flat-pickr>
                                                <span v-show="errors.has('registration_date')" class="form-text text-danger">{{ errors.first('registration_date') }}</span>
                                                
                                                
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                </div>
                                                
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
                    
                    <div  class="col-md-4 comp-grid" :class="setGridSize">
                        
                        <div class="card">
                            <b-tabs horizontal  card class="nav-fill" >
                            
                            <b-tab title="<i class='material-icons '>recent_actors</i> LATEST PATIENTS ID-GENERATED">
                            
                            <div class=" position-relative mb-2">
                                <div  class="bg-white " >
                                <datamenu  title="" datapath="components/patientsgenerated_id_list" pagelinkpath="#" valuekey="generated_id" labelkey="" menuicon='<i class="material-icons ">account_box</i>' menuclass="nav nav-pills flex-column"></datamenu>
                            </div>
                        </div>
                        <div class="card-body text-center"></div>
                        
                        </b-tab>
                        
                        </b-tabs>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
</section>
</template>

<script>
    
    var PatientsAddComponent = Vue.component('patientsAdd', {
    template : '#patientsAdd',
    mixins: [AddPageMixin],
    props:{
    pagename : {
    type : String,
    default : 'patients',
    },
    apipath : {
    type : String,
    default : 'patients/add',
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
    first_name: '',last_name: '',gender: '',facilitie: '',doctor_name: '',registration_date: '',
    },
    
    genderOptionList: ["Male","Female"],
    }
    },
    computed: {
    pageTitle: function(){
    return 'Add New Patients';
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
    if(route.name == 'patientsadd' ){
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
    self.$router.push('/patients/Add');
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
    this.data = {first_name: '',last_name: '',gender: '',facilitie: '',doctor_name: '',registration_date: '',};
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
