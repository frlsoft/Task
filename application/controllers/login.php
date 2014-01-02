<?php
class Login extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->model ( 'login/login_model' );
	}
	/**
	 * 默认的登录页面
	 */
	public function index() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		$this->load->view ( 'login/index' );
	}
	
	/**
	 * 判断用户是否存在
	 */
	public function check_user_login_info() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// 用户名、密码验证
		$this->form_validation->set_rules ( 'username', '用户名', 'required' );
		$this->form_validation->set_rules ( 'password', '密码', 'required' );
		
		if ($this->form_validation->run () === FALSE) { // 验证失败 返回登录页面
			$this->load->view ( 'login/index' );
		} else { // form 验证通过，验证数据库是否存在此用户
			$data = $this->login_model->user_exists ();
			if ($data) {
				// 获取用户菜单权限
				$menu =  $this->login_model->get_user_menu();
				//print_r($menu);
				$this->load->view ( 'main', $menu );
			} else {
				$this->load->view ( 'fail' );
			}
		}
	}
}