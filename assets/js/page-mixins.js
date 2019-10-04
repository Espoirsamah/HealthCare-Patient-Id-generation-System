
	var ListPageMixin = {
		props: {
			resetgrid : {
				type : Boolean,
				default : false,
			},
			page : {
				type : Number,
				default : 1,
			},
			search : {
				type : String,
				default : '',
			},
			fieldname : {
				type : String,
				default : '',
			},
			fieldvalue : {
				type : String,
				default : '',
			},
			sortby : {
				type : String,
				default : '',
			},
			sorttype : {
				type : String,
				default : '', //desc or asc
			},
			backbutton : {
				type : Boolean,
				default : true,
			},
			showheader : {
				type : Boolean,
				default : true,
			},
			showfooter: {
				type : Boolean,
				default : true,
			},
		},
		data: function () {
			return {
			  loading : false,
				ready: false,
				loadcompleted : false,
				selected:[],
				allSelected: false,
				totalrecords :1,
				records : [],
				includeFilters : true,
				filterParams:{},
				deleting : null,
				currentpage : 1,
				orderby : '',
				ordertype : '',
				filterby : '',
				filterText : '',
				filtervalue : '',
				filterMsgs : [],
				searchtext : '',
				errorMsg : '',
				modalComponentName: '',
				modalComponentProps: '',
				popoverTarget : '',
				showError: false,
			}
		},
		computed: {
			apiUrl: function() {
				var path = this.apipath;
				if(this.filterby){
					path = path + '/' + encodeURIComponent(this.filterby) + '/' + encodeURIComponent(this.filtervalue);
				}
				var query = {
					limit_start : this.currentpage,
					limit_count : this.pagelimit,
					orderby : this.orderby,
					ordertype : this.ordertype,
					search : this.searchtext,
				};
				if(this.includeFilters == true){
					query =  extend(query , this.filterParams);
				}
				var url = setApiUrl(path , query);
				return url;
			},
			disableScroll: function(){
				return this.loading || this.loadcompleted || !this.paginate;
			},
			currentItemsCount: function(){
				return this.records.length;
			},
			setGridSize: function(){
				if(this.resetgrid){
					return 'col-sm-12 col-md-12 col-lg-12';
				}
			},
		},
		watch : {
			fieldvalue: function(){
				this.records = [];
				this.loadcompleted = false;
				this.filterby = this.fieldname;
				this.filtervalue = this.fieldvalue;
				this.load();
			},
			
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
			filterGroupChange: function(){
				this.filterGroup();
			},
		},
		methods:{
			sort: function(fieldname){
				this.orderby = fieldname;
				if(this.ordertype == 'desc'){
					this.ordertype = 'asc'
				}
				else{
					this.ordertype = 'desc'
				}
				this.records = [];
				this.load();
			},
			limitChanged: function(num){
				this.pagelimit = num;
				this.load();
			},
			changepage: function(page){
				this.currentpage = page;
				this.load();
			},
			dosearch: function(){
				if(this.searchtext){
					this.filterMsgs = ["Search: " +  this.searchtext];
				}
				else{
					this.filterMsgs = [];
				}
				this.includeFilters = false;
				this.records = [];
				this.load();
				this.includeFilters = true;
			},
			
			filter: function(filter){
				this.records = [];
				this.loadcompleted = false;
				this.filterParams = filter;
				this.load();
			},
			
			showPageModal: function(compProps){
				this.$root.$emit('showPageModal' , compProps);
			},
			
			deleteRecord : function(recid , index){
				var recids = recid || this.selected.toString();
				if(recids){
					var prompt = this.promptmessagebeforedelete;
					
					if (prompt != ""){
						if(!confirm(prompt)){
							return;
						}
					}
					var url = setApiUrl(this.pagename + '/delete/' + recids);
					this.deleting = recid;
					this.$http.get(url).then(function (response) {
						if(index){
							this.deleting = null;
							this.records.splice(index,1);
							if(this.msgafterdelete){
								this.$root.$emit('requestCompleted' , this.msgafterdelete);
							}
						}
						else{
							this.load();
						}
					},
					function (response) {
						this.deleting = null;
						this.errorMsg = response.statusText;
						this.showError = true;
					});
				}
			},
			exportRecord : function(){
				this.exportPage(this.$refs.datatable.innerHTML, this.pageTitle);
			},
		},
		mounted : function() {
			this.showError = false;
			this.filterby = this.fieldname;
			this.filtervalue = this.fieldvalue;
			this.pagelimit = this.limit;
			this.page = this.page;
			
			if(this.$route.query.sortby){
				this.orderby = this.$route.query.sortby;
			}
			else{
				this.orderby = this.sortby;
			}
			
			if(this.$route.query.sorttype){
				this.ordertype = this.$route.query.sorttype;
			}
			else{
				this.ordertype = this.sorttype;
			}

			this.searchtext = this.search;
			this.load();
		},

		created: function(){
			this.SetPageTitle(this.pageTitle);
			var vm = this;
			bus.$on('refresh' , function(){
				vm.load();
			});
		},
	}
	
	var ViewPageMixin = {
		props: {
			id : {
				type : String,
				default : '',
			},
			fieldname : {
				type : String,
				default : '',
			},
			fieldvalue : {
				type : String,
				default : '',
			},
			isModal : {
				type : Boolean,
				default : false,
			},
			backbutton : {
				type : Boolean,
				default : true,
			},
			showheader : {
				type : Boolean,
				default : true,
			},
			showfooter: {
				type : Boolean,
				default : true,
			},
		},
		data : function() {
			return {
				filterby : '',
				filtervalue : '',
				ready : false,
				loading : false,
				showError: false,
				errorMsg : '',
			}
		},
		computed: {
			setGridSize: function(){
				if(this.resetgrid){
					return 'col-sm-12 col-md-12 col-lg-12';
				}
			},
			apiUrl: function() {
				var path = this.apipath;
				if(this.filterby){
					path = path + '/' + this.filterby + '/' + this.filtervalue;
				}
				else{
					path = path + '/' + this.id
				}
				var url = setApiUrl(path);
				return url;
			},
		},
		methods :{
			load : function(){
				this.resetData();
				this.loading = true;
				this.showError = false;
				this.ready = false;
				this.$http.get(this.apiUrl).then(function (response) {
					this.data = response.body;
					this.loading = false;
					this.ready = true;
				},
				
				function (response) {
					this.loading = false;
					this.errorMsg = response.statusText;
					this.showError = true;
				});
			},
			deleteRecord : function(recid){
				var recid = this.id;
				var prompt = this.promptmessagebeforedelete;
				if (prompt != ""){
					if(!confirm(prompt)){
						return;
					}
				}
				var url = setApiUrl( this.pagename + '/delete/' + recid);
				this.$http.get(url).then(function (response) {
					if(this.msgafterdelete){
						this.$root.$emit('requestCompleted' , this.msgafterdelete);
						this.$router.push(url);
					}
				},
				function (response) {
					this.errorMsg = response.statusText;
					this.showError = true;
				});
			},
			showPageModal: function(compProps){
				this.$root.$emit('showPageModal' , compProps);
			},
			
			exportRecord : function(){
				this.exportPage(this.$refs.datatable.innerHTML, this.pageTitle);
			}
		},
		watch : {
			id : function(){
				if(this.id){
					this.load();
				}
			},
			fieldname : function(){
				this.filterby = this.fieldname;
				this.filtervalue = this.fieldvalue;
				this.load();
			},
			fieldvalue : function(){
				this.filterby = this.fieldname;
				this.filtervalue = this.fieldvalue;
				this.load();
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle( this.pageTitle );
			var vm = this;
			bus.$on('refresh' , function(){
				vm.records = [];
				vm.load();
			});
		},
		mounted : function() {
			this.filterby = this.fieldname;
			this.filtervalue = this.fieldvalue;
			this.load();
		},
	}
	
	var AddPageMixin = {
		props:{
			resetgrid : {
				type : Boolean,
				default : false,
			},
			showheader : {
				type : Boolean,
				default : true,
			},
			
			submitAction : {
				type : String,
				default : 'submit',
			},
			informwizard : {
				type : Boolean,
				default : false,
			},
			
			modelBind: {
				type: Object,
				default: function () { return {} }
			}
		},
		data : function() {
			return {
				saving : false,
				ready : false,
				errorMsg : '',
				showError: false,
			}
		},
		computed: {
			setGridSize: function(){
				if(this.resetgrid){
					return 'col-sm-12 col-md-12 col-lg-12';
				}
			}
		},
		watch: {
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		methods : {
			
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted : function() {
			this.showError = false;
			this.ready = true;
		},
	}
	
	var EditPageMixin = {
		props: {
			id : {
				type : String,
				default : '',
			},
			resetgrid : {
				type : Boolean,
				default : false,
			},
			
			showheader : {
				type : Boolean,
				default : true,
			},
			informwizard : {
				type : Boolean,
				default : false,
			},
			
			submitAction : {
				type : String,
				default : 'submit',
			},
			backbutton : {
				type : Boolean,
				default : true,
			},
			ismodal : {
				type : Boolean,
				default : false,
			},
			modelBind: {
				type: Object,
				default: function () { return {} }
			}
		},
		data: function() {
			return {
				errorMsg : '',
				showError: false,
				loading : false,
				ready: false,
				saving : false,
			}
		},
		computed: {
			setGridSize: function(){
				if(this.resetgrid){
					return 'col-sm-12 col-md-12 col-lg-12';
				}
			}
		},
		methods: {
			
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
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
			this.load();
		},
		
	}
	
	