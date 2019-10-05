
<template id="usersList">
    <section class="page-component">
        
        <div v-if="showheader" class="jumbotron sm">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-sm-4 comp-grid" :class="setGridSize">
                        <div class=""><h4>Users</h4> <hr class='d-block d-sm-none' />
                            <nav v-if="fieldname" class="page-header-breadcrumbs" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-2">
                                    <li class="breadcrumb-item"><router-link class="text-capitalize" to="/users">{{ fieldname }}</router-link></li>
                                    <li class="breadcrumb-item active"  class="text-capitalize" aria-current="page">{{ fieldvalue }}</li>
                                </ul>
                            </nav></div>
                        </div>
                        
                        <div  class="col-sm-3 comp-grid" :class="setGridSize">
                            
                            <router-link v-if="addbutton" class="btn btn btn-primary btn-block" :to="'/users/add'">
                            <i class="material-icons">add</i>
                            Add New Users
                            </router-link>
                            
                        </div>
                        
                        <div v-if="searchfield" class="col-sm-5 comp-grid" :class="setGridSize">
                            
                            <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Search" />
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    
                    <div class="row ">
                        
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            
                            <div  class=" animated fadeIn">
                                <b-alert :show="showError" variant="danger"  class="animated bounce" dismissible @dismissed="showError=false">
                                <i class="material-icons">error</i> {{errorMsg}}
                                </b-alert>
                                <div class="">
                                    <div v-if="filterMsgs.length" class=" page-header">
                                        <strong>Filters</strong> : <span class="chip bg-light text-muted" v-for="msg in filterMsgs" v-html="msg"></span>
                                    </div>
                                    
                                    <div v-if="records.length" ref="datatable">
                                        <div class="row">
                                            
                                            <div class="col-sm-4" v-for="(data,index) in records" >
                                                <div class="card p-2 mb-4">
                                                    
                                                    <div>
                                                        <strong>User Name</strong> :  {{ data.user_name }} 
                                                    </div>
                                                    
                                                    <div>
                                                        <strong>First Name</strong> :  {{ data.first_name }} 
                                                    </div>
                                                    
                                                    <div>
                                                        <strong>Last Name</strong> :  {{ data.last_name }} 
                                                    </div>
                                                    
                                                    <div>
                                                        <strong>Email</strong> :  {{ data.email }} 
                                                    </div>
                                                    
                                                    <div>
                                                        <niceimg :path="data.picture" width="50" height="50" ></niceimg> 
                                                    </div>
                                                    
                                                    <div>
                                                        <strong>User Role</strong> :  {{ data.user_role }} 
                                                    </div>
                                                    
                                                    
                                                    <div >
                                                        
                                                        <button v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" @click="showPageModal({page:'usersView',  id:data.id})">
                                                            <i class="material-icons">visibility</i> View
                                                        </button>
                                                        
                                                        
                                                        <button v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" @click="showPageModal({page:'usersEdit', id: data.id})">
                                                            <i class="material-icons">edit</i> Edit
                                                        </button>
                                                        
                                                        
                                                        <button  v-if="deletebutton" class="btn btn-outline-danger btn-sm" @click="deleteRecord(data.id,index)" title="Delete This Record">
                                                            <span v-show="deleting != data.id"><i class="material-icons">clear</i></span>
                                                            Delete
                                                            <clip-loader :loading="deleting == data.id" color="#fff" size="20px"></clip-loader>
                                                        </button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div v-if="!records.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center">
                                        <h4><i class="material-icons">block</i> {{emptyrecordmsg}}</h4>
                                    </div>
                                    
                                    <div v-show="loading" class="load-indicator static-center">
                                        <span class="animator">
                                            <clip-loader :loading="loading" color="gray" size="20px">
                                            </clip-loader>
                                        </span>
                                        <h4 style="color:gray" class="loading-text">Loading...</h4>
                                    </div>
                                    
                                    <div v-if="paginate" class="page-header">
                                        
                                        <div v-if="paginate">
                                            <pagination
                                                :total-items="totalrecords"
                                                :current-items-count="currentItemsCount"
                                                :items-per-page="limit"
                                                :offset="5"
                                                :show-record-count="true"
                                                :show-page-count="true"
                                                :show-page-limit="true"
                                                @limit-changed="limitChanged"
                                                @changepage="changepage">
                                                
                                            </pagination>
                                        </div>
                                        
                                    </div>
                                    <div v-if="showfooter" class="page-footer">
                                        
                                        <button @click="deleteRecord()" v-if="selected.length" class="btn btn-sm btn-danger">
                                            <i class="material-icons">clear</i> Delete
                                        </button>
                                        
                                        
                                        <button @click="exportRecord()" v-if="exportbutton" class="btn btn-sm btn-primary"><i class="material-icons">save</i> Export</button>
                                        
                                        
                                        <dataimport extensions="" buttontext="Import Data" post-action="users/import_data" v-if="importbutton"></dataimport>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </section>
    </template>
    
    <script>
        
        var UsersListComponent = Vue.component('usersList', {
        template: '#usersList',
        mixins: [ListPageMixin],
        props: {
        limit : {
        type : Number,
        default : defaultPageLimit,
        },
        pagename : {
        type : String,
        default : 'users',
        },
        apipath : {
        type : String,
        default : 'users/list',
        },
        paginate : {
        type : Boolean,
        default : true,
        },
        searchfield : {
        type : Boolean,
        default : true,
        },
        addbutton : {
        type : Boolean,
        default : true,
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
        importbutton : {
        type : Boolean,
        default : true,
        },
        viewbutton : {
        type : Boolean,
        default : true,
        },
        tablestyle : {
        type : String,
        default : ' table-striped table-sm',
        },
        listsequence : {
        type : Boolean,
        default : true,
        },
        multicheckbox : {
        type : Boolean,
        default : true,
        },
        emptyrecordmsg : {
        type : String,
        default : 'No Record Found',
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
        data: function() {
        return {
        pagelimit : defaultPageLimit,
        
        
        }
        },
        computed : {
        pageTitle: function(){
        return 'Users';
        },
        filterGroupChange: function(){
        return ;
        },
        
        },
        watch : {
        '$route': function(route){
        if(route.name == 'userslist' ){
        this.SetPageTitle( this.pageTitle );
        var query = route.query;
        if(query.sortby || query.sorttype){
        if(query.sortby){
        this.orderby = query.sortby;
        }
        if(query.sorttype){
        this.ordertype = query.sorttype;
        }
        this.records = [];
        this.loadcompleted = false;
        
        }
        this.load();
        }
        },
        
        
        allSelected: function(){
        //toggle selected record
        this.selected = [];
        if(this.allSelected == true){
        for (var i in this.records){
        var id = this.records[i].id;
        this.selected.push(id);
        }
        }
        
        }
        
        },
        methods:{
        
        load:function(){
        this.records = [];
        if (this.loading == false){
        this.ready = false;
        this.loading = true;
        var url = this.apiUrl;
        this.$http.get(url).then(function (response) {
        var data = response.body;
        if(data.records){
        this.totalrecords = data.total_records ;
        if(this.pagelimit  > data.records.length){
        this.loadcompleted = true;
        }
        this.records = data.records;
        }
        else{
        this.$root.$emit('pageError' , data);
        }
        
        this.loading = false
        this.ready = true
        
        },
        function (response) {
        this.loading = false;
        this.errorMsg = response.statusText;
        this.showError = true;
        });
        }
        },  
        
        filterGroup: function(){
        var filters = {};
        this.filterMsgs = [];
        
        
        
        this.filter(filters);
        },
        
        },
        mounted : function() {
        
        },
        created: function(){
        
        },
        });
        
    </script>
    
    <style>
        <!--  Component Style Goes Here -->
    </style>
    