
<template id="accountView">
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
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-bold">Update Account</h5>
                                    <hr />
                                    <b-nav vertical>
                                    <b-nav-item to="/account/edit"><i class="material-icons">edit</i> Edit Account</b-nav-item>
                                    <b-nav-item href="<?php print_link('passwordmanager') ?>"><i class="material-icons">lock</i> Reset Password</b-nav-item>
                                    <b-nav-item href="<?php print_link('account/change_email') ?>"><i class="material-icons">account_circle</i> Change Email</b-nav-item>
                                    </b-nav>
                                </div>
                                <div class="col-sm-9">
                                    <div>
                                        <h5 class="text-bold">Account Detail</h5>
                                        <hr />
                                        <table class="table table-hover table-borderless table-striped">
                                            <tbody>
                                                
                                                <tr>
                                                    <th class="title"> Id :</th>
                                                    <td class="value"> {{ data.id }} </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th class="title"> User Name :</th>
                                                    <td class="value"> {{ data.user_name }} </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th class="title"> First Name :</th>
                                                    <td class="value"> {{ data.first_name }} </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th class="title"> Last Name :</th>
                                                    <td class="value"> {{ data.last_name }} </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th class="title"> Email :</th>
                                                    <td class="value"> {{ data.email }} </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th class="title"> Picture :</th>
                                                    <td class="value"><niceimg :path="data.picture" width="400" height="400" ></niceimg> </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th class="title"> User Role :</th>
                                                    <td class="value"> {{ data.user_role }} </td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    
    var AccountViewComponent = Vue.component('accountView', {
    template : '#accountView',
    mixins: [ViewPageMixin],
    props: {
    pagename: {
    type : String,
    default : 'account',
    },
    apipath: {
    type : String,
    default : 'account',
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
    if(route.name == 'accountaccountview' ){
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
