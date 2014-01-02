<?php
class Module extends CI_Controller {
	//
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		
		$sessionKey = $this->session->all_userdata ();
		if (! array_key_exists ( 'NAME', $sessionKey )) {
			exit ( '超时' );
		}
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'module_model' );
		//echo '<pre>';
	}
	
	/**
	 */
	public function index() {
		$data ['modules'] = $this->module_model->module_list ();
		$this->load->view ( 'module/list', $data );
	}
	
	/**
	 * 添加模块
	 */
	function add() {
		$this->edit ();
	}
	/**
	 * 编辑模块信息
	 */
	function edit() {
		$data ['modules'] = array ();
		$params = $this->uri->uri_to_assoc ();
		// echo $params ['gid'];
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['editing'] = $this->module_model->load ( $gid );
			if (! $data ['editing']) {
				return array (
						'info' => 'gid:' . $gid . 'module no exists' 
				);
			}
			// 预处理用户数据
			$user_list = array ();
			foreach ( $data ['editing'] ['module_list'] as $key => $attr ) {
				$user_list [$attr ['id']] ['id'] = $attr ['id'];
				$user_list [$attr ['id']] ['mname'] = $attr ['mname'];
				$user_list [$attr ['id']] ['uuid'] = $attr ['uuid'];
				$user_list [$attr ['id']] ['ctime'] = $attr ['ctime'];
			}
		} else { // 准备空数据 及默认数据
			$data = array ();
		}
		// print_r($data);
		// $data ['orgs'] = $this->module_model->find_org_sets ();
		// 装载视图
		$this->load->view ( 'module/edit', $data );
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
				$arr ['message'] = $this->module_model->update ();
			} else { // 新增
				$arr ['message'] = $this->module_model->create ();
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
	 * 模块对应菜单设置
	 */
	function moduleMappingMenu() {
		$this->load->model ( 'menu_model' );
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['uuid'] )) {
			$gid = $params ['uuid'];
			$data = array ();
			$data['gid'] = $gid;
			$data ['allmenus'] = $this->menu_model->list_menu ();
			foreach ( $data ['allmenus'] as $key => $attr ) {
				$temp [$attr ['UID']] = $attr;
			}
			$data ['allmenus'] = $temp;
			unset ( $temp );
			$data ['menus'] = $this->module_model->get_modelu_menus ( $gid );
			foreach ( $data ['menus'] as $key => $attr ) {
				$temp [$attr ['UID']] = $attr;
			}
			$data ['menus'] = $temp;
			unset ( $temp );
		}
		if ($data ['menus']) {
			$data ['menudiff'] = array_diff_key ( $data ['allmenus'], $data ['menus'] );
		} else {
			$data ['menudiff'] = $data ['allmenus'];
		}
		
		// print_r($data);
		// 剩余菜单
		// print_r(array_diff_key($data['allmenus'] , $data['menus']));
		//print_r ( $data );
		$this->load->view ( 'module/moduleMappingMenu', $data );
	}
	
	function savemoduleMappingMenu(){
		$data = $this->module_model->saveMappingData();
		echo JSON($data);
	}
	/**
	 * 设置验证规则
	 */
	function _set_save_form_rules() {
		$rules = array (
				array (
						'field' => 'mname',
						'label' => 'mname',
						'rules' => 'trim|required' 
				) 
		);
		$this->form_validation->set_message ( 'required', 'field required erroe' );
		// $this->form_validation->set_message('trim', '不能为空');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // 去掉界定符号
		$this->form_validation->set_rules ( $rules );
	}
}
