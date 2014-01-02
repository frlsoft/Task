<?php
class Help extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
	}
	/**
	 * 帮助文档
	 */
	public function index() {
		$params = $this->uri->uri_to_assoc ();
		$data ['an'] = array (
				$params ['an'] 
		);
		$this->load->view ( 'help', $data );
	}
}