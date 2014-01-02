<?php
class Char extends CI_Controller {
	function __construct() {
		parent::__construct ();
		//error_reporting ( 1 );
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
	}
	
	public function index() {
		$this->load->view('char');
	}
}