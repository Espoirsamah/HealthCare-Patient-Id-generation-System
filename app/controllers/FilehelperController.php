<?php
/**
 * File Helper Controller
 *
 * @category  File Helper
 */

class FilehelperController extends BaseController{
	
	/**
     * Convinient Function For Resizing and cropping Image Via Url
     * @example http://mysite.com/filehelper/resizeimg?image=uploads/images/58jh78asgre2.jpg&width=100&height=100
     * @return Image
     */
	function resizeimg(){
		if(empty($_GET['cropratio'])){
			if(!empty($_GET['width']) && !empty($_GET['height'])){
				if($_GET['width'] == $_GET['height']){
					$_GET['cropratio']='1:1';
				}
			}
		}
		require (HELPERS_DIR . "ImageResize.php");
	}
	
	/**
     * Force The Download Of A File
     * @return File
     */
	function downloadfile(){
		
	}
	
	/**
     * Upload A file to the server
     * @return JSON String
     */
	function uploadfile(){
		$uploader=new Uploader;
		// Get Upload Config From POST Request
		$config=transform_request_data($_POST);
		$upload_data=$uploader->upload($_FILES['file'], $config);
		if($upload_data['isComplete']){
			$files = $upload_data['data'];
			$path = $upload_data['data']['files'][0];
			
			if(!empty($config['returnfullpath'])){
				echo set_url($path);
			}
			else{
				echo $path;
			}
		}

		if($upload_data['hasErrors']){
			$errors = $upload_data['errors'];
			Json :: error ($errors);
		}
	}
}
