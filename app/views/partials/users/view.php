
<template id="usersView">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <div class=""><h4>Users View</h4> <hr class='d-block d-sm-none' /></div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div  class="pb-2 mb-3 border-bottom">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-md-12 comp-grid" :class="setGridSize">
                        
                        <div  class=" animated fadeIn">
                            <div class="profile-bg">
                                <div class="profile">
                                    <div class="d-flex flex-row justify-content-center">
                                        <div class="avatar"><niceimg width="100" height="100" :path="data.picture"></niceimg></div>
                                        <h2 class="title">{{data.user_name}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-bold">Account Detail</h5>
                                <hr />
                                
                                <div class="detail-list">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            User Name
                                        </div>
                                        <div class="col-sm-9">
                                            {{ data.user_name }} 
                                        </div>
                                    </div>
                                </div>
                                
                                
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
                                            Email
                                        </div>
                                        <div class="col-sm-9">
                                            {{ data.email }} 
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="detail-list">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            Picture
                                        </div>
                                        <div class="col-sm-9">
                                            <niceimg :path="data.picture" width="400" height="400" ></niceimg> 
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="detail-list">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            User Role
                                        </div>
                                        <div class="col-sm-9">
                                            {{ data.user_role }} 
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div v-if="editbutton || deletebutton" class="mt-2">
                                
                                <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/users/edit/'  + data.id">
                                <i class="material-icons">edit</i> Edit
                                </router-link>
                                
                                
                                <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/users/delete/' + data.id">
                                <i class="material-icons">clear</i> Delete</button>
                            </div>
                            
                            <div v-show="loading" class="load-indicator static-center">
                                <span class="animator">
                                    <clip-loader :loading="loading" color="gray" size="20px">
                                    </clip-loader>
                                </span>
                                <h4 style="color:gray" class="loading-text">Loading...</h4>
                            </div>
                            
                            <div class="text-muted" v-if="!data && emptyrecordmsg != '' && !loading">
                                <h4><i class="material-icons">block</i> No Record Found</h4>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
</template>

<script>
    
    var UsersViewComponent = Vue.component('usersView', {
    template : '#usersView',
    mixins: [ViewPageMixin],
    props: {
    pagename: {
    type : String,
    default : 'users',
    },
    apipath: {
    type : String,
    default : 'users/view',
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
    id: '',user_name: '',first_name: '',last_name: '',email: '',picture: '',user_role: '',
    },
    },
    
    }
    },
    computed: {
    pageTitle: function(){
    return 'Users View';
    },
    
    },
    methods :{
    resetData : function(){
    this.data = {
    id: '',user_name: '',first_name: '',last_name: '',email: '',picture: '',user_role: '',
    }
    },
    },
    watch : {
    '$route': function(route){
    if(route.name == 'usersview' ){
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
