
<template id="patientsView">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Patients View</h4> <hr class='d-block d-sm-none' /></div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div  class="pb-2 mb-3 border-bottom">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-md-12 comp-grid" :class="setGridSize">
                        
                        <div  class=" animated fadeIn">
                            <div v-show="!loading">
                                <b-alert  class="animated bounce" :show="showError" variant="danger" dismissible @dismissed="showError=false">
                                <i class="material-icons">error</i> {{errorMsg}}
                                </b-alert>
                                <div ref="datatable" id="datatable">
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                First Name
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.first_name }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Last Name
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.last_name }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Gender
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.gender }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Generated ID
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.generated_id }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Facilitie
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.facilitie }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Doctor Name
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.doctor_name }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="detail-list">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Registration Date
                                            </div>
                                            <div class="col-sm-9">
                                                {{ data.registration_date }} 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                                <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                    <span >
                                        
                                        <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/patients/edit/'  + data.id">
                                        <i class="material-icons">edit</i> Edit
                                        </router-link>
                                        
                                        
                                        <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/patients/delete/' + data.id">
                                        <i class="material-icons">clear</i> Delete</button>
                                    </span>
                                    
                                    <button @click="exportRecord" class="btn btn-sm btn-primary" v-if="exportbutton">
                                        <i class="material-icons">save</i> Export Record
                                    </button>
                                    
                                </div>
                            </div>
                            
                            
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
    
    var PatientsViewComponent = Vue.component('patientsView', {
    template : '#patientsView',
    mixins: [ViewPageMixin],
    props: {
    pagename: {
    type : String,
    default : 'patients',
    },
    apipath: {
    type : String,
    default : 'patients/view',
    },
    editbutton : {
    type : Boolean,
    default : true,
    },
    deletebutton : {
    type : Boolean,
    default : true,
    },
    exportbutton : {
    type : Boolean,
    default : true,
    },
    
    promptmessagebeforedelete : {
    type : String,
    default : 'Are you Sure you Want to Delete this Record',
    },
    msgafterdelete : {
    type : String,
    default : 'Record Deleted Successfully',
    },
    },
    data : function() {
    return {
    data : {
    default :{
    id: '',first_name: '',last_name: '',gender: '',generated_id: '',facilitie: '',doctor_name: '',registration_date: '',
    },
    },
    
    }
    },
    computed: {
    pageTitle: function(){
    return 'Patients View';
    },
    
    },
    methods :{
    resetData : function(){
    this.data = {
    id: '',first_name: '',last_name: '',gender: '',generated_id: '',facilitie: '',doctor_name: '',registration_date: '',
    }
    },
    },
    watch : {
    '$route': function(route){
    if(route.name == 'patientsview' ){
    this.SetPageTitle( this.pageTitle );
    }
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
