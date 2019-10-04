<?php 

/**
 * Patients Page Controller
 * @category  Controller
 */
class PatientsController extends SecureController{
	
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
		
		$fields = array('id', 	'first_name', 	'last_name', 	'age', 	'gender', 	'registration_date', 	'generated_id');
		
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		
		if(!empty($this->search)){
			$text=$this->search;
			
			$db->orWhere('id',"%$text%",'LIKE');
			$db->orWhere('first_name',"%$text%",'LIKE');
			$db->orWhere('last_name',"%$text%",'LIKE');
			$db->orWhere('age',"%$text%",'LIKE');
			$db->orWhere('gender',"%$text%",'LIKE');
			$db->orWhere('registration_date',"%$text%",'LIKE');
			$db->orWhere('generated_id',"%$text%",'LIKE');
		}

		
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		
		
		
		
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('patients', $limit, $fields);
		
		
		
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
					$options = array('table' => 'patients', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'patients' , false );
				}
				
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error("Error uploading file  'patients'");
			}
		}
	}
	

	


	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
	
		$db = $this->GetModel();
		
		
		$fields = array( 'id', 	'first_name', 	'last_name', 	'age', 	'gender', 	'registration_date', 	'generated_id' );
		
		
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id' , $rec_id);
		}
		
		  
		$record = $db->getOne( 'patients', $fields );

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
				
				'first_name' => 'required',
				'last_name' => 'required',
				'age' => 'required|numeric',
				'gender' => 'required',
				'registration_date' => 'required',
				'generated_id' => 'required|alpha_num',
			);
			$db1 = $this->GetModel();
                        $users = $db1->rawQueryOne('SELECT count(*) as nbr from patients where date(registration_date) BETWEEN ? AND ?', array(date("Y-m-")."01",date("Y-m-")."31"));
			$nbpat = (int) $users['nbr'];
                        $nbpat++;
                        $genr_id = "SPH-".$nbpat."-".date('m')."/".date('y');
                        $modeldata['generated_id'] = $genr_id;
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			
			$db = $this->GetModel();
			
			
			$rec_id = $db->insert('patients',$modeldata);
			
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
			if(isset($modeldata['generated_id'])){
				$db->where('generated_id',$modeldata['generated_id'])->where('id',$rec_id,'!=');
				if($db->has('patients')){
					render_error($modeldata['generated_id']. " Already Exist!");
				}
			} $db->where('id' , $rec_id);
			$bool = $db->update('patients',$modeldata);
			if($bool){
				
				
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','first_name','last_name','age','gender','registration_date','generated_id');
			$db->where('id' , $rec_id);
			$data = $db->getOne('patients',$fields);
			
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
		
		
		$bool = $db->delete( 'patients' );
		
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
