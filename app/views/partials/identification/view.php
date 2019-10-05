
<template id="identificationView">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Identification View</h4> <hr class='d-block d-sm-none' /></div>
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
                                    <table class="table table-hover table-borderless table-striped">
                                        <!-- Table Body Start -->
                                        <tbody>
                                            
                                            <tr>
                                                <th class="title"> Id :</th>
                                                <td class="value"> {{ data.id }} </td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <th class="title"> Generated Id :</th>
                                                <td class="value"> {{ data.generated_id }} </td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <th class="title"> Patients Id :</th>
                                                <td class="value"> {{ data.patients_id }} </td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                        <!-- Table Body End -->
                                    </table>
                                </div>
                                
                                <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                    <span >
                                        
                                        <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/identification/edit/'  + data.id">
                                        <i class="material-icons">edit</i> Edit
                                        </router-link>
                                        
                                        
                                        <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/identification/delete/' + data.id">
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
    
    var IdentificationViewComponent = Vue.component('identificationView', {
    template : '#identificationView',
    mixins: [ViewPageMixin],
    props: {
    pagename: {
    type : String,
    default : 'identification',
    },
    apipath: {
    type : String,
    default : 'identification/view',
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
    id: '',generated_id: '',patients_id: '',
    },
    },
    
    }
    },
    computed: {
    pageTitle: function(){
    return 'Identification View';
    },
    
    },
    methods :{
    resetData : function(){
    this.data = {
    id: '',generated_id: '',patients_id: '',
    }
    },
    },
    watch : {
    '$route': function(route){
    if(route.name == 'identificationview' ){
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
