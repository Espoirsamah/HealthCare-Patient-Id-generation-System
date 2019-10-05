<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="<?php echo PAGE_CHARSET ?>">
		<link rel="shortcut icon" href="<?php print_link(SITE_FAVICON); ?>" />
		<?php 
			Html ::  page_title(SITE_NAME);
			Html ::  page_meta('theme-color',META_THEME_COLOR);
			Html ::  page_meta('author',META_AUTHOR); 
			Html ::  page_meta('keyword',META_KEYWORDS); 
			Html ::  page_meta('description',META_DESCRIPTION); 
			Html ::  page_meta('viewport',META_VIEWPORT);
			Html ::  page_css('material-icons.css');
			Html ::  page_css('animate.css');
			Html ::  page_css('bootstrap-vue.min.css');
			Html ::  page_css('vue-form-wizard.css');
			Html ::  page_css('flatpickr.min.css');
			
		?>
				<?php 
			Html ::  page_css('bootstrap-theme-simlex-teal-white.css');
			Html ::  page_css('custom-style.css');
		?>
	</head>
	
	<?php
		$page_id = "IndexPage";

		if(user_login_status() == true){
			$page_id = "HomePage";
		}
	?>

	<body id="<?php echo $page_id ?>">

		<div id="app" v-cloak>
			<appheader></appheader>
			
			<div id="main-content">
				<div class="container">
					<b-alert variant="danger" :show="showPageError" @dismissed="showPageError=0" dismissible>
						<h4 class="bold"><i class="material-icons">error</i> Error Processing Request</h4>
						<div v-html="pageErrorMsg"></div>
					</b-alert>
					
					<b-alert class="fixed-alert bottom-left animated bounce" :show="showFlash" @dismissed="showFlash=0" variant="success" dismissible>
						<p><i class="material-icons">check_circle</i> {{flashMsg}}</p>
					</b-alert>
					
					<div class="page-modal">
						<b-modal v-model="showModalView" size="lg">
							<span slot="modal-header"></span>
							<component :is="modalComponentName" v-bind="modalComponentProps"></component>
							<div slot="modal-footer"></div>
						</b-modal>
					</div>
				</div>
				<keep-alive>
					<router-view></router-view>
				</keep-alive>
			</div>
			
			<appfooter></appfooter>
			
			<!-- for Record Export -->
			<form method="post" action="<?php print_link('report') ?>" target="_blank" id="exportform">
				<input type="hidden" name="data" id="exportformdata" />
				<input type="hidden" name="title" id="exportformtitle" />
			</form>
			<!-- for image preview -->
			<nicecarousel></nicecarousel>
		</div>
		
		
		<script>
			var apiUrl = '<?php SITE_ADDR; ?>';
			var ActiveUser = <?php echo json_encode(get_active_user()); ?>;
			var defaultPageLimit = <?php echo MAX_RECORD_COUNT; ?>;
		</script>
		
		
		
		<?php 
			Html ::  page_js('vue-2.5.13.js');
			Html ::  page_js('polyfill.min.js');
			Html ::  page_js('bootstrap-vue.js');
			Html ::  page_js('vue-bundle.js');
			
			Html ::  page_js('page-mixins.js');
			
			$components = array(
				'index/index.php','index/register.php','identification/list.php','identification/view.php','identification/add.php','identification/edit.php','patients/list.php','patients/view.php','patients/add.php','patients/edit.php','users/list.php','users/view.php','account/edit.php','account/view.php','users/add.php','users/edit.php',
			);
			
			$this->load_view("components/utils.php");
			$this->load_view("home/index.php");
			$this->load_view("components/appheader.php");
			$this->load_view("components/appfooter.php");
			$this->load_view("components/componentnotfound.php");
			
			foreach($components as $comp){
				$this->load_view($comp);
			}
			
			
			
			Html ::  page_js('flatpickr.min.js');
			Html ::  page_js('vue-flat-pickr.min.js');

			
			
			Html ::  page_js('vue-script.js');
		?>
		
		<script>
			
			
		
			
			var bus = new Vue({});
			var routes = [
			  
				<?php
					if( user_login_status() == true ){
						echo "{ path: '/', name: 'home' , component: HomeComponent },";
					}
					else {
						echo "{ path: '/', name: 'index', component: IndexComponent },
						{ path: '/register', name: 'register', component: RegisterComponent },";
					}
				?>

				{ path: '/identification', name: 'identificationlist', component: IdentificationListComponent },
				{ path: '/identification/(index|list)', name: 'identificationlist' , component: IdentificationListComponent },
				{ path: '/identification/(index|list)/:fieldname/:fieldvalue', name: 'identificationlist' , component: IdentificationListComponent , props: true },
				{ path: '/identification/view/:id', name: 'identificationview' , component: IdentificationViewComponent , props: true},
				{ path: '/identification/view/:fieldname/:fieldvalue', name: 'identificationview' , component: IdentificationViewComponent , props: true },
				{ path: '/identification/add', name: 'identificationadd' , component: IdentificationAddComponent },
				{ path: '/identification/edit/:id' , name: 'identificationedit' , component: IdentificationEditComponent , props: true},
				{ path: '/identification/edit', name: 'identificationedit' , component: IdentificationEditComponent , props: true},

				{ path: '/patients', name: 'patientslist', component: PatientsListComponent },
				{ path: '/patients/(index|list)', name: 'patientslist' , component: PatientsListComponent },
				{ path: '/patients/(index|list)/:fieldname/:fieldvalue', name: 'patientslist' , component: PatientsListComponent , props: true },
				{ path: '/patients/view/:id', name: 'patientsview' , component: PatientsViewComponent , props: true},
				{ path: '/patients/view/:fieldname/:fieldvalue', name: 'patientsview' , component: PatientsViewComponent , props: true },
				{ path: '/patients/add', name: 'patientsadd' , component: PatientsAddComponent },
				{ path: '/patients/edit/:id' , name: 'patientsedit' , component: PatientsEditComponent , props: true},
				{ path: '/patients/edit', name: 'patientsedit' , component: PatientsEditComponent , props: true},

				{ path: '/users', name: 'userslist', component: UsersListComponent },
				{ path: '/users/(index|list)', name: 'userslist' , component: UsersListComponent },
				{ path: '/users/(index|list)/:fieldname/:fieldvalue', name: 'userslist' , component: UsersListComponent , props: true },
				{ path: '/users/view/:id', name: 'usersview' , component: UsersViewComponent , props: true},
				{ path: '/users/view/:fieldname/:fieldvalue', name: 'usersview' , component: UsersViewComponent , props: true },
				{ path: '/account/edit', name: 'accountedit' , component: AccountEditComponent },
				{ path: '/account', name: 'accountview' , component: AccountViewComponent },
				{ path: '/users/add', name: 'usersadd' , component: UsersAddComponent },
				{ path: '/users/edit/:id' , name: 'usersedit' , component: UsersEditComponent , props: true},
				{ path: '/users/edit', name: 'usersedit' , component: UsersEditComponent , props: true},

				{ path: '/home', name: 'home' , component: HomeComponent },
				{ path: '*', name: 'pagenotfound' , component: ComponentNotFound }
			];
			
			var router = new VueRouter({
				routes:routes,
				linkExactActiveClass:'active',
				linkActiveClass:'active',
			   // mode:'history'
			});
			
			router.beforeEach(function(to, from, next) {
				document.body.className = to.name;
				next();
			});
			var app = new Vue({
				el: '#app',
				router: router,
				data:{
					showPageError : false,
					pageErrorMsg : '',
					modalComponentName: '',
					modalComponentProps: '',
					popoverTarget : '',
					showModalView : false,
					showFlash : false,
					flashMsg : '',
				},
				
				mounted : function(){
					this.$on('requestCompleted' ,  function (msg) {
						this.showModal = false;
						if(msg){
							this.showFlash = 3 ;
							this.flashMsg = msg ;
						}
						bus.$emit('refresh');
					});
					
					this.$on('pageError' ,  function (msg) {
						this.pageErrorMsg = msg ;
						this.showPageError = true ;
					})
					
					this.$on('requestError' ,  function (response) {
						
					})
					
					this.$on('showPageModal' ,  function (props) {
						if(props.page){
							this.modalComponentName = props.page;
							delete props.page;
							props.resetgrid = true; // reset columns so that page components will fit well
							this.modalComponentProps = props;
							this.showModalView = true;
						}
						else{
							console.error("No Page Defined")
						}
					})
					
					this.$on('showPopOver' ,  function (props) {
						if(props.page && props.target){
							this.modalComponentName = props.page;
							this.popoverTarget = props.target;
							delete props.page;
							delete props.target;
							props.resetgrid=true;
							this.modalComponentProps = props;
						}
						else{
							console.error("No Page or Target  Defined")
						}
					})
					
					this.$on('showListModal' ,  function (arr) {
						this.modalComponentName = arr[0];
						this.modalFieldName = arr[1];
						this.modalFieldValue = arr[2];
						this.showModalList = true;
					})
					
				}
			});
		</script>
		
	</body>
</html>