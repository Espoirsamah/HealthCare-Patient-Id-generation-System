
<template id="identificationAdd">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Add New Identification</h4> <hr class='d-block d-sm-none' /></div>
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
                            
                            
                            <form enctype="multipart/form-data" @submit="save" class="form form-default" action="identification/add" method="post">
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('generated_id')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="generated_id">Generated Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.generated_id"
                                                v-validate="'required:true'"
                                                data-vv-as="Generated Id"
                                                class="form-control "
                                                type="text"
                                                name="generated_id"
                                                placeholder="Enter Generated Id"
                                                
                                                />
                                                <small v-show="errors.has('generated_id')" class="form-text text-danger">
                                                    {{ errors.first('generated_id') }}
                                                </small>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group " :class="{'has-error' : errors.has('patients_id')}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="patients_id">Patients Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <input v-model="data.patients_id"
                                                v-validate="'required:true|numeric'"
                                                data-vv-as="Patients Id"
                                                class="form-control "
                                                type="number"
                                                name="patients_id"
                                                placeholder="Enter Patients Id"
                                                step="1" 
                                                />
                                                <small v-show="errors.has('patients_id')" class="form-text text-danger">
                                                    {{ errors.first('patients_id') }}
                                                </small>
                                                
                                                
                                                
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
    
    var IdentificationAddComponent = Vue.component('identificationAdd', {
    template : '#identificationAdd',
    mixins: [AddPageMixin],
    props:{
    pagename : {
    type : String,
    default : 'identification',
    },
    apipath : {
    type : String,
    default : 'identification/add',
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
    generated_id: '',patients_id: '',
    },
    
    }
    },
    computed: {
    pageTitle: function(){
    return 'Add New Identification';
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
    if(route.name == 'identificationadd' ){
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
    self.$router.push('/identification');
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
    this.data = {generated_id: '',patients_id: '',};
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
