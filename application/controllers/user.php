<?php
class User extends CI_Controller {
	function __construct() {
		parent::__construct ();
		if (! $this->session->userdata ( 'logged_in' )) {
			// redirect('login');
			$arr ['message'] = array (
					'flag' => '0',
					'info' => 'time out' 
			);
			echo json_encode ( $arr );
			exit ();
		}
		error_reporting ( 1 );
		$this->load->helper ( 'form' );
		// 加载表单验证类
		$this->load->library ( 'form_validation' );
		// 加载用户模型
		$this->load->model ( 'user/user_model' );
	}

	function index() {

	}

	/**
	 * 显示用户列表
	 */
	function listUser(){
		$data ['users'] = $this->user_model->find_users ();
		$data ['orgs'] = $this->org_model->find_org_sets ();
		$this->load->view ( 'user/list', $data );
	}

	/**
	 * 添加用户
	 */
	function add() {
		$this->edit ();
	}
	/**
	 * 编辑用户信息
	 */
	function edit() {
		$data ['user'] = array ();
		$params = $this->uri->uri_to_assoc ();
		// echo $params ['gid'];
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['editing'] = $this->user_model->load ( $gid );
			if (! $data ['editing']) {
				return array (
						'gid:' . $gid,
						'user' 
				);
			}
			// 预处理用户数据
			$user_list = array ();
			foreach ( $data ['editing'] ['user_list'] as $key => $attr ) {
				$user_list [$attr ['ID']] ['ID'] = $attr ['ID'];
				$user_list [$attr ['ID']] ['NAME'] = $attr ['NAME'];
				$user_list [$attr ['ID']] ['GID'] = $attr ['GID'];
				$user_list [$attr ['ID']] ['SHOWNAME'] = $attr ['SHOWNAME'];
				$user_list [$attr ['ID']] ['ORGID'] = $attr ['ORGID'];
				$user_list [$attr ['ID']] ['yhbh'] = $attr ['yhbh'];
			}
		} else { // 准备空数据 及默认数据
			$data = array ();
		}
		
		$data ['orgs'] = $this->org_model->find_org_sets ();
		// 装载视图
		$this->load->view ( 'user/edit', $data );
	}
	/**
	 * 保存用户数据
	 */
	function save() {
		// 用户gid
		$gid = $this->input->post ( 'gid' );
		// 验证规则
		$this->_set_save_form_rules ();
		if (TRUE === $this->form_validation->run ()) {
			if ($gid) { // 编辑
				$arr ['message'] = $this->user_model->update ();
			} else { // 新增
				$arr ['message'] = $this->user_model->create ();
			}
		} else {
			$arr ['message'] = array (
					'flag' => '0',
					'info' => validation_errors () 
			);
		}
		echo JSON ( $arr );
	}
	/**
	 * 删除
	 */
	function in_recycle() {
		$params = $this->uri->uri_to_assoc ();
		$flag = $this->user_model->delete ( $params ['gid'] );
		if ($flag) {
			$arr ['message'] = array (
					'flag' => '1' 
			);
		} else {
			$arr ['message'] = array (
					'flag' => '0' 
			);
		}
		echo JSON ( $arr );
	}
	/**
	 * 设置验证规则
	 */
	function _set_save_form_rules() {
		$rules = array (
				array (
						'field' => 'name',
						'label' => 'name',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'password',
						'label' => 'password',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'yhbh',
						'label' => 'yhbh',
						'rules' => 'trim|required' 
				) 
		);
		$this->form_validation->set_message ( 'required', 'field required erroe' );
		// $this->form_validation->set_message('trim', '不能为空');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // 去掉界定符号
		$this->form_validation->set_rules ( $rules );
	}
}