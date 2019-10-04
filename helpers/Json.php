<?php
class Json{
	
	public static function render( $data ){
		//header('Content-type: application/json');
		echo json_encode($data);
	}
	
	public static function error( $data = null ){
		header('Content-type: application/json');
		echo json_encode($data);
	}
}