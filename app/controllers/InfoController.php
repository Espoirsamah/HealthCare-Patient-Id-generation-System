<?php
/**
 * Info Contoller Class
 * @category  Controller
 */

class InfoController extends BaseController{

	/**
     * Display About us page
     * @return Html View
     */
	function about(){
		$this->view->render("info/about.php" ,null,"default_layout.php");
	}

	/**
     * Display Help Page
     * @return Html View
     */
	function help(){
		$this->view->render("info/help.php" ,null,"default_layout.php");
	}
	
	/**
     * Display Features Page
     * @return Html View
     */
	function features(){
		$this->view->render("info/features.php" ,null,"default_layout.php");
	}
	
	/**
     * Display Privacy Policy Page
     * @return Html View
     */
	function privacy_policy(){
		$this->view->render("info/privacy_policy.php" ,null,"default_layout.php");
	}

	/**
     * Display Terms And Conditions Page
     * @return Html View
     */
	function terms_and_conditions(){
		$this->view->render("info/terms_and_conditions.php" ,null,"default_layout.php");
	}

	/**
     * Display Contact us Page
     * @return Html View
     */
	function contact(){
		if(!empty($_POST)){
			$email=$_POST['email'];
			$name=$_POST['name'];
			$msg=$_POST['msg'];
			$title="New Contact us Message From $name";
			
			$mailer=new Mailer;
			
			$mailer->From=$email;
			$mailer->FromName=$name;
			
			$mailer->send_mail(DEFAULT_EMAIL, $title, $msg);
			
			redirect_to_action("contact_send");
		}
		else{
			$this->view->render("info/contact.php" ,null,"default_layout.php");
		}
	}
	
	/**
     * Display Contact Success Page After Sending Form
     * @return Html View
     */
	function contact_send(){
		$this->view->render("info/contact_send.php" ,null,"default_layout.php");
	}
	
	/**
     * Display Contact Success Page After Sending Form
     * @return Html View
     */
	function report(){
		$this->view->render("info/contact_send.php" ,null,"default_layout.php");
	}
	
}
