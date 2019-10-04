<?php 
	defined('ROOT') OR exit('No direct script access allowed');

	/**
	* Application Base View
	*/
	class BaseView{
		/**
	     * Data Passed From Controller to the View
	     * Can Be Access By All Other Sub View in The Page
	     * @var  object
	     */
		public $model=null;
		
		
		/**
	     * Render Page In Following Format [html | json | xml]
		 * Can Be Pass Via Query String
	     * @var  object
	     */
		public $format="html";

		/**
	     * Set Page Title From The Controller
	     * @var string
	     */
		public $page_title=null;

		/**
	     * Model Data passed From Controller to The View
	     * @var string
	     */
		public $view_data=null;
		
		/**
	     * Other Data passed From Controller to The View
	     * @var string
	     */
		public $view_bag=null;
		
		/**
	     * The Relative Path of The View File
	     * @var string
	     */
		public $view_name=null;

		/**
	     * Whether to Render View as a Partial View Without The Layout
	     * @var boolean
	     */
		public $is_partial_view=false;

		/**
	     * The Relative Path of Partial View File
	     * @var string
	     */
		public $partial_view=null;
		
		/**
	     * The Relative Path of Partial View File
	     * @var string
	     */
		public $force_layout=null;
		
		
		function __construct($arg=null){
			// Pass All Query String Data to the View.
			$q=$_GET;
			if(!empty($q)){
				foreach($q as $obj=>$val){
					$this->$obj=$val;
				}
			}
		}

		/**
	     * Render Main Page From The Controller 
	     * @return null
	     */
		public function render($view_name=null,$view_data=null,$layout=null){
			$this->view_name=$view_name;
			
			//pass data from controller unto the view.
			$this->view_data=$view_data;
			
			
			//If force_layout is set then use the layout.
			if(!empty($this->force_layout)){
				$layout=$this->force_layout;
			}
			
			//Do not Include Layout if Render as a Partial View in another View
			if(!empty($layout) && $this->is_partial_view==false){
				if(file_exists(LAYOUTS_DIR . $layout)){
					include (LAYOUTS_DIR . $layout);
				}
				else{
					echo "The Layout Does not Exit;";
				}
			}
			else{
				
				/* 
					use the partial_view if it's set
					Get View name from current page url if not passed from controller 
				*/
				
                if(!empty($this->partial_view)){		
					
                    $view_name=$this->partial_view;
                }
				else if(empty($view_name)){				
					
					 $view_name=Router :: $page_name . "/" . Router :: $page_action . ".php";
				}
                
                if(file_exists(PAGES_DIR . $view_name)){
                    include (PAGES_DIR . $view_name);
                }
                else{
                    print_r($view_name) ;
                }
				
			}
		}
		
		
		/**
	     * Render Main Page From The Controller onto the Layout
	     * @return null
	     */
		protected function render_body(){
			$view=PAGES_DIR . $this->view_name;
			if(file_exists($view)){
				include($view);
			}
			else{
				echo "$view File Not Found";
			}
		}

		/**
	     * Include View Onto A Page as A Partial View 
	     * @example $this->load_view("components/bar_chart.php");
	     * @return null
	     */
		protected function load_view($viewname,$args=null){
			$this->view_args=$args;
			$view=PAGES_DIR . $viewname;
			if(file_exists($view)){
				include($view);
			}
			else{
				echo "$view File  Not Found";
			}
		}
		
		/**
	     * Render Page as a Partial View Onto Another Page Using Url Parameters
	     * @example call inside any view or layout 
		 * $this->render_page("users/index/status/active/?limit_start=1&limit_count=5&orderby=user_id&ordertype=desc");
	     * @return null
	     */
		protected function render_page($url,$view=null){
			$qs=parse_url($url,PHP_URL_QUERY);
			parse_str($qs,$get);
			$_GET=array();
			
			
			if(!empty($get)){ //build new $_GET array from query string
				foreach($get as $key=>$val){
					$_GET[$key]=$val;
				}
			}
			
			$path=parse_url($url,PHP_URL_PATH); // Get Path from URL
			
			
			//Dispatch as new page
			$r=new Router;
			$r->is_partial_view=true;
			$r->partial_view=$view;
			$r->run($path);
			
		}
	}