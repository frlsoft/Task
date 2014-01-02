<?php
class Test extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
	}
	/**
	 * 默认的登录页面
	 */
	public function index() {
		$this->load->view("template");
		//echo $this->JSON($arr);
	}
}