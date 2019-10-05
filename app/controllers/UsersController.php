<?php 

/**
 * Users Page Controller
 * @category  Controller
 */
class UsersController extends SecureController{
	
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
	
		$db = $this->GetModel();
		
		$fields = array('id', 	'user_name', 	'first_name', 	'last_name', 	'email', 	'picture', 	'user_role');
		
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		
		if(!empty($this->search)){
			$text=$this->search;
			
			$db->orWhere('id',"%$text%",'LIKE');
			$db->orWhere('user_name',"%$text%",'LIKE');
			$db->orWhere('first_name',"%$text%",'LIKE');
			$db->orWhere('last_name',"%$text%",'LIKE');
			$db->orWhere('password',"%$text%",'LIKE');
			$db->orWhere('email',"%$text%",'LIKE');
			$db->orWhere('picture',"%$text%",'LIKE');
			$db->orWhere('user_role',"%$text%",'LIKE');
		}

		
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		
		
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE) , $allowed_roles)){
			
			$db->where("last_name" , USER_ID );
			$db->orWhere("email" , USER_ID );
		}
		
		
		
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('users', $limit, $fields);
		
		
		
		$data = new stdClass;

		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);

		render_json($data);
		
	}
	
	
	/**
     * Load csv|json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('csv','json'))){
				render_error('File format not supported');
			}
			
			
			$file_path = $_FILES['file']['tmp_name'];

			
			if(!empty($file_path)){
				$db = $this->GetModel();
				
				if($ext == 'csv'){
					$options = array('table' => 'users', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'users' , false );
				}
				
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error("Error uploading file  'users'");
			}
		}
	}
	

	


	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
	
		$db = $this->GetModel();
		
		
		$fields = array( 'id', 	'user_name', 	'first_name', 	'last_name', 	'email', 	'picture', 	'user_role' );
		
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE) , $allowed_roles)){
			
			$db->where("last_name" , USER_ID );
			$db->orWhere("email" , USER_ID );
		}
		
		
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id' , $rec_id);
		}
		
		  
		$record = $db->getOne( 'users', $fields );

		if(!empty($record)){
			
			
			
			render_json($record);
		}
		else{
			if($db->getLastError()){
				render_error($db->getLastError());
			}
			else{
				render_error("Record Not Found",404);
			}
		}
	}
	


	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			
			

			$modeldata=transform_request_data($_POST);

			$rules_array = array(
				
				'user_name' => 'required',
				'password' => 'required',
				'email' => 'valid_email',
				'user_role' => 'required',
			);
			
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			
			
			$cpassword = $modeldata['confirm_password'];
			$password = $modeldata['password'];
			if($cpassword != $password){
				render_error('Your Password Does not Conform to be Unique');
			}
			unset($modeldata['confirm_password']);
			
			
			$password_text = $modeldata['password'];
			$modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);
			
			
			$db = $this->GetModel();
			
			
			$rec_id = $db->insert('users',$modeldata);
			
			if(!empty($rec_id)){
				
				
				render_json($rec_id);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Error Inserting New Record");
				}
			}
		}
		else{
			render_error("Invalid Request Method");
		}
	}


	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id=null){
		$db = $this->GetModel();
		if(is_post_request()){
			
			
			$modeldata=transform_request_data($_POST); 
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['user_name'])){
				$db->where('user_name',$modeldata['user_name'])->where('id',$rec_id,'!=');
				if($db->has('users')){
					render_error($modeldata['user_name']. " Already Exist!");
				}
			} 
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE) , $allowed_roles)){
			
			$db->where("last_name" , USER_ID );
			$db->orWhere("email" , USER_ID );
		}
		$db->where('id' , $rec_id);
			$bool = $db->update('users',$modeldata);
			if($bool){
				
				
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','user_name','first_name','last_name','picture','user_role');
			
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE) , $allowed_roles)){
			
			$db->where("last_name" , USER_ID );
			$db->orWhere("email" , USER_ID );
		}
		$db->where('id' , $rec_id);
			$data = $db->getOne('users',$fields);
			
			if(!empty($data)){
				render_json($data);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Record Not Found",404);
				}
			}
		}
	}


	/**
     * Delete Record Action 
     * @return View
     */
	function delete( $rec_ids = null ){
		
		$db = $this->GetModel();
		
		$arr_id = explode( ',', $rec_ids );
		foreach( $arr_id as $rec_id ){
			$db->where('id' , $rec_id,"=",'OR');
		}
		
		$allowed_roles = array ('administrator');
		if(!in_array(strtolower(USER_ROLE) , $allowed_roles)){
			
			$db->where("last_name" , USER_ID );
			$db->orWhere("email" , USER_ID );
		}
		
		
		$bool = $db->delete( 'users' );
		
		if($bool){
			 
			render_json( $bool );
		}
		else{
			if($db->getLastError()){
				render_error($db->getLastError());
			}
			else{
				render_error("Error Deleting Record. Please Make sure that the Record Exit");
			}
		}
	}


}
