
<template id="identificationEdit">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Edit Identification</h4> <hr class='d-block d-sm-none' /></div>
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
                            <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'identification/edit/' + data.id" method="post">
                                
                                
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
    
    var IdentificationEditComponent = Vue.component('identificationEdit', {
    template : '#identificationEdit',
    mixins: [EditPageMixin],
    props: {
    pagename : {
    type : String,
    default : 'identification',
    },
    apipath : {
    type : String,
    default : 'identification/edit',
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
    data : { generated_id: '',patients_id: '', },
    
    }
    },
    computed: {
    pageTitle: function(){
    return 'Edit Identification';
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
    self.$router.push('/identification');
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
    if(route.name == 'identificationedit' ){
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
