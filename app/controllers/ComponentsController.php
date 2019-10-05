<?php 

/**
 * Component Model
 * @category  Model
 */
class ComponentsController extends BaseController{
	
	/**
     * patientsgenerated_id_list Model Action
     * @return array
     */
	function patientsgenerated_id_list(){
		$db = $this->GetModel();
		$sqltext="SELECT generated_id
FROM patients
ORDER BY id DESC
LIMIT 1";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr);
	}

	/**
     * getcount_patients Model Action
     * @return Value
     */
	function getcount_patients(){
		$db = $this->GetModel();
		$sqltext="SELECT COUNT(*) AS num FROM patients";
		$arr=$db->rawQueryValue($sqltext);
		
		render_json($arr[0]) ;
	}

	/**
     * getcount_users Model Action
     * @return Value
     */
	function getcount_users(){
		$db = $this->GetModel();
		$sqltext="SELECT COUNT(*) AS num FROM users";
		$arr=$db->rawQueryValue($sqltext);
		
		render_json($arr[0]) ;
	}

}
