
<template id="Index">
    <div>
        
        <div  class="pb-2 mb-3 border-bottom my-5">
            <div class="container">
                
                <div class="row ">
                    
                    <div  class="col-sm-8 comp-grid" :class="setGridSize">
                        <div class="">
                            <div class="fadeIn animated mb-4">
                                <div class="text-capitalize">
                                    <h2 class="text-capitalize">Welcome To <?php echo SITE_NAME ?></h2>
                                </div>
                                <br />
                                <p>
                                    Develop Amazing Applications Easily.<br />
                                    Advance your project developement with <strong class="text-success">PHPRAD</strong>
                                </p>
                                <br />
                                <div>
                                    <a class="btn btn-danger btn-md" href="<?php print_link('info/about') ?>"><i class="material-icons">help</i> Learn More</a>
                                    <a class="btn btn-primary btn-md" href="<?php print_link('info/features') ?>"><i class="material-icons">assignment</i> Features</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div  class="col-sm-4 comp-grid" :class="setGridSize">
                        
                        <div  class=" animated fadeIn">
                            
                            <div class="card card-body">
                                <div><h4><i class="material-icons">lock_open</i> User Login</h4></div>
                                <hr />
                                <div>
                                    <b-alert class="animated shake" :show="showError" variant="danger" dismissible @dismissed="showError=false">
                                    {{errorMsg}}
                                    </b-alert>
                                    <form name="loginForm" action="<?php print_link('index/login'); ?>" @submit.prevent="login()" method="post">
                                        <div class="input-group form-group">
                                            <input placeholder="Username Or Email" v-model="user.username" name="username"  required="required" class="form-control" type="text"  />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="form-control-feedback material-icons">account_circle</i></span>
                                            </div>
                                        </div>
                                        
                                        <div class="input-group form-group">
                                            <input  placeholder="Password" required="required" v-model="user.password" name="password" class="form-control" type="password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="form-control-feedback material-icons">lock</i></span>
                                            </div>
                                        </div>
                                        <div class="row clearfix mt-3 mb-3">
                                            
                                            <div class="col-6">
                                                <label class="">
                                                    <input value="true" type="checkbox" name="rememberme" />
                                                    Remember Me
                                                </label>
                                            </div>
                                            
                                            <div class="col-6">
                                                <a href="<?php print_link('passwordmanager') ?>" class="text-danger">Forgot Password ? </a>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary btn-block btn-md" type="submit">
                                                <i class="load-indicator">
                                                    <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader>
                                                </i>
                                                Login <i class="material-icons">lock_open</i>
                                            </button>
                                        </div>
                                        <hr />
                                        
                                        <div class="text-center">
                                            Don't Have Account ? <router-link to="/register" class="btn btn-lg btn-success" type="submit">Register
                                            <i class="material-icons">account_box</i></router-link>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
    var IndexComponent = Vue.component('IndexComponent', {
    template : '#Index',
    data : function() {
    return {
    user : {
    username : '',
    password : '',
    },
    loading : false,
    ready: false,
    errorMsg : '',
    showError: false
    }
    },
    computed: {
    setGridSize: function(){
    if(this.resetgrid){
    return 'col-sm-12 col-md-12 col-lg-12';
    }
    }
    },
    methods : {
    login : function(e){
    var payload = this.user;
    this.loading = true;
    var self = this;
    var apiurl = setApiUrl('index/login');
    this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
    setTimeout(function(){
    self.loading = false;
    window.location = response.body;
    }, 500);
    },
    function (response) {
    this.loading = false;
    this.errorMsg = response.statusText;
    this.showError = true;
    });
    }
    },
    mounted : function() {
    this.ready = true;
    },
    });
    
</script>
