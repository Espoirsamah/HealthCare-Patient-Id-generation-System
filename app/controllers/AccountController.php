<?php 

/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$db->where ("id", USER_ID);
		$user = $db->getOne('users' , '*');
		render_json($user);
	}
	
	
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit(){
		$db = $this->GetModel();
		if(is_post_request()){
			
			
			$modeldata=transform_request_data($_POST); 
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['user_name'])){
				$db->where('user_name',$modeldata['user_name'])->where('id',USER_ID,'!=');
				if($db->has('users')){
					render_error($modeldata['user_name']. " Already Exist!");
				}
			} 
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE) , $allowed_roles)){
			
			$db->where("last_name" , USER_ID );
			$db->orWhere("email" , USER_ID );
		}
		$db->where('id' , USER_ID);
			$bool = $db->update('users',$modeldata);
			if($bool){
				$db->where ('id', USER_ID);
				$user = $db->getOne('users' , '*');
				set_session('user_data',$user);

				
				
				render_json(USER_ID);
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
		$db->where('id' , USER_ID);
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
     * Change Email Action
     * @return View
     */
	function change_email(){
		if(is_post_request()){
			
			$form_collection = $_POST;
			$email=trim($form_collection['email']);
			
			
			$db = $this->GetModel();
			
			$db->where ("id", USER_ID);
			$result = $db->update('users', array('email' => $email ));
			if($result){
				
				set_flash_msg('Email Changed Successfully','success');
				redirect_to_page("#/account");
			}
			else{
				$this->view->form_error="Email Not Changed ";
				$this->view->render("account/change_email.php" ,null,"default_layout.php");
			}
		}
		else{
			$this->view->render("account/change_email.php" ,null,"default_layout.php");
		}
	}
}
