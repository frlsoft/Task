<?php
class Help extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
	}
	/**
	 * �����ĵ�
	 */
	public function index() {
		$params = $this->uri->uri_to_assoc ();
		$data ['an'] = array (
				$params ['an'] 
		);
		$this->load->view ( 'help', $data );
	}
}