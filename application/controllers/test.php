<?php
class Test extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
	}
	/**
	 * Ĭ�ϵĵ�¼ҳ��
	 */
	public function index() {
		$this->load->view("template");
		//echo $this->JSON($arr);
	}
}