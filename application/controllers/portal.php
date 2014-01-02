<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Portal extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'portal_model' );
		// echo '<pre>';
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function index() {
		error_reporting ( 1 ); // $this->load->view ( 'portal' );
		$data = array (
				'title' => '项目管理系统' 
		);
		$this->load->view ( 'login/index', $data );
	}
	
	/**
	 * 判断用户是否存在
	 */
	function init() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// 验证规则
		$this->_set_save_form_rules ();
		if ($this->form_validation->run () === FALSE) { // 验证失败 返回登录页面
		                                                // $this->load->view ( 'portal' );
			$data ['message'] = array (
					'flag' => '0',
					'info' => validation_errors () 
			);
		} else { // form 验证通过，验证数据库是否存在此用户
			$data ['message'] = $this->portal_model->user_exists ();
			if ($data) {
				// 获取用户菜单权限
				// $data['menu'] = $this->portal_model->get_user_menu ();
				// print_r($menu);
				// $this->load->view ( 'main', $data );
			} else {
				// $this->load->view ( 'fail' );
			}
		}
		echo JSON ( $data );
	}
	
	/**
	 * 加载主窗体
	 */
	function main() {
		$data = $this->portal_model->get_user_menu ();
		// print_r($menu);
		$this->load->view ( 'main/main', $data );
	}
	function signin() {
	}
	/**
	 * 初始化框架top
	 */
	function top() {
		$data = $this->portal_model->get_user_menu ();
		$data ['userdata'] = $this->session->all_userdata ();
		$data ['orgs'] = $this->session->all_userdata ();
		// print_r($data);
		$this->load->view ( 'main/top', $data );
	}
	/**
	 * 初始化框架left
	 */
	function left($module = '0000000000') {
		// 按传递参数获取菜单数据
		// $menu ['menus'] = $this->portal_model->get_user_menu ();
		$menu ['menus'] = $this->module_model->get_modelu_menu ( $module );
		$menu ['model'] = $this->module_model->get_module_name ( $module );
		$this->load->view ( 'main/left', $menu );
	}
	function right_top() {
		$data ['modules'] = $this->module_model->get_user_module ();
		$data ['location'] = array (
				'首页 →',
				'用户信息→',
				'操作日志' 
		);
		$this->load->view ( 'main/right_top', $data );
	}
	function right() {
		$this->load->view ( 'main/right' );
	}
	
	/**
	 * 初始化框架center
	 */
	function center() {
		$this->load->view ( 'center' );
	}
	
	/**
	 * 退出并注销
	 */
	function loginOut() {
		$this->session->sess_destroy ();
		// header ( base_url () );
	}
	
	/**
	 * 设置验证规则
	 */
	function _set_save_form_rules() {
		$rules = array (
				array (
						'field' => 'username',
						'label' => 'username',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'upassword',
						'label' => 'upassword',
						'rules' => 'trim|required' 
				) 
		);
		$this->form_validation->set_message ( 'required', 'field required erroe' );
		// $this->form_validation->set_message('trim', '不能为空');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // 去掉界定符号
		$this->form_validation->set_rules ( $rules );
	}
}

/* End of file portal.php */
/* Location: ./application/controllers/portal.php */