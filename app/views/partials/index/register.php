
<template id="Register">
	<section class="page-component">
		
		<div v-if="showheader" class="jumbotron sm">
			<div class="container">
				
				<div class="row ">
					
				<div  class="col-sm-6 comp-grid" :class="setGridSize">
							<div class=""><h4>User Registration</h4></div>
				</div>

				<div  class="col-sm-6 comp-grid" :class="setGridSize">
							<div class="">
	<div class="text-right">
		Already have an account ?  <router-link class="btn btn-primary" to="/"> Login </router-link>
	</div>
</div>
				</div>

				</div>
			</div>
		</div>

		<div  class="pb-2 mb-3 border-bottom">
			<div class="container">
				
				<div class="row ">
					
				<div  class="col-md-7 comp-grid" :class="setGridSize">
							
					<div  class=" animated fadeIn">
						<form enctype="multipart/form-data" @submit="save" class="form form-default" action="" method="post">
		
								
								<div class="form-group " :class="{'has-error' : errors.has('user_name')}">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="user_name">User Name <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
											<input v-model="user.user_name"
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
												
											<input v-model="user.first_name"
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
												
											<input v-model="user.last_name"
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

				

								
								<div class="form-group " :class="{'has-error' : errors.has('password')}">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="password">Password <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
											<input v-model="user.password"
												v-validate="'required:true'"
												data-vv-as="Password"
												class="form-control "
												type="password"
												name="password"
												placeholder="Enter Password"
												
											/>
											<small v-show="errors.has('password')" class="form-text text-danger">
												{{ errors.first('password') }}
											</small>
									

												
											</div>
											 
											
										</div>
									</div>
								</div>

				
								
								<div class="form-group " :class="{'has-error' : errors.has('confirm_password')}">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
									<input
										v-model="user.confirm_password"
										v-validate="'required:true|confirmed:password'"
										data-vv-as="Confirm Password"
										class="form-control "
										type="password"
										name="confirm_password"
										placeholder="Confirm Password"

									/>
									<small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>


												
											</div>
											 
											
										</div>
									</div>
								</div>

				

								
								<div class="form-group " :class="{'has-error' : errors.has('email')}">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="email">Email <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
											<input v-model="user.email"
												v-validate="'required:true|email'"
												data-vv-as="Email"
												class="form-control "
												type="email"
												name="email"
												placeholder="Enter Email"
												
											/>
											<small v-show="errors.has('email')" class="form-text text-danger">
												{{ errors.first('email') }}
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
								v-model="user.picture"
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
										v-model="user.user_role"
										data-vv-value-path="user.user_role"
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

				



		<b-alert  class="animated bounce" :show="showError" variant="danger" dismissible @dismissed="showError=false">
			<i class="material-icons">error</i> {{errorMsg}}
		</b-alert>
		<hr />
		<div class="text-center">
			<button class="btn btn-primary" type="submit">
				<i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="20px"></clip-loader> </i>
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
	
	var RegisterComponent = Vue.component('Register', {
		template : '#Register',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'users',
			},
			apipath : {
				type : String,
				default : 'index/register',
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
				user : {
					user_name: '',first_name: '',last_name: '',password: '',confirm_password: '',email: '',picture: '',user_role: '',
				},
				
				user_roleOptionList: [{"label":"User","value":"User"}],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Users';
			},
		},
		watch: {
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.user[key]= binds[key];
				}
			},
			'$route': function(route){
				if(route.name == 'usersuserregister' ){
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
						var payload = self.user;
						var url = setApiUrl(self.apipath);
						if(submitAction == 'submit'){
							self.saving = true;
							self.$http.post( url , payload , {emulateJSON:true} ).then(function (response) {
								self.saving = false
								self.$root.$emit('requestCompleted' , self.msgaftersave);
								self.resetForm();
								window.location = response.body;
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
				this.user = {user_name: '',first_name: '',last_name: '',password: '',confirm_password: '',email: '',picture: '',user_role: '',};
				this.$validator.reset();
			},
			uploadcompleted : function(arg){
				this.user[arg.field]= arg.result;
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
