<?php
class Menu extends CI_Controller {
	// 锟斤拷锟届函锟斤拷
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		// 锟叫讹拷锟矫伙拷锟角凤拷锟窖撅拷锟斤拷陆系统
		$sessionKey = $this->session->all_userdata ();
		if (! array_key_exists ( 'NAME', $sessionKey )) {
			exit ( '超时重新登陆' );
		}
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'menu_model' );
	}
	
	/**
	 * 默锟较的碉拷录页锟斤拷
	 */
	public function index() {
		echo '';
	}
	
	function add(){
		$this->edit();
	}
	function edit(){
		$data['menu'] = array();
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['editing'] = $this->menu_model->load ( $gid );
			if (! $data ['editing']) {
				return array (
						'gid:' . $gid,
						'user'
				);
			}
			// 预处理用户数据
			$menu_list = array ();
			foreach ( $data ['editing'] ['menu_list'] as $key => $attr ) {
				$menu_list [$attr ['UID']] ['UID'] = $attr ['ID'];
				$menu_list [$attr ['UID']] ['MNAME'] = $attr ['NAME'];
				$menu_list [$attr ['UID']] ['URL'] = $attr ['URL'];
			}
		} else { // 准备空数据 及默认数据
			$data = array ();
		}
		//echo '<pre>';
		//print_r($data);
		$this->load->view('menu/edit',$data);
	}
	
	/**
	 * 保存菜单数据
	 */
	function save() {
		// 用户gid
		$gid = $this->input->post ( 'gid' );
		// 验证规则
		$this->_set_save_form_rules ();
		if (TRUE === $this->form_validation->run ()) {
			if ($gid) { // 编辑
				$arr ['message'] = $this->menu_model->update ();
			} else { // 新增
				$arr ['message'] = $this->menu_model->create ();
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
	 * 锟斤拷硬说锟�
	 */
	public function addMenu($mid = '') {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// 锟矫伙拷锟斤拷锟斤拷锟斤拷锟斤拷证
		$this->form_validation->set_rules ( 'name', 'name', 'required' );
		$this->form_validation->set_rules ( 'url', 'url', 'required' );
		
		if ($this->form_validation->run () === FALSE) { // 锟斤拷证失锟斤拷 锟斤拷锟截碉拷录页锟斤拷
			$data = array (
					'mid' => $mid 
			);
			$this->load->view ( 'menu/add', $data );
		} else { // form 锟斤拷证通锟斤拷
			$data = $this->menu_model->set_menu ();
			if ($data) {
				$this->load->view ( 'menu/success', $data );
			} else {
				$this->load->view ( 'fail', $data );
			}
		}
	}
	
	/**
	 * 锟斤拷示锟剿碉拷锟斤拷锟�
	 *
	 * @param string $menuid        	
	 */
	public function listMenu($menuid = FALSE) {
		if ($menuid === FALSE) {
			$data ['result'] = $this->menu_model->list_menu ();
			// echo '<pre>';
			// print_r($data);
			$this->load->view ( 'menu/list', $data );
		}
	}
	/**
	 *
	 * @param string $mid        	
	 */
	public function getMenu($pmid = '') {
		$data ['result'] = $this->menu_model->get_menu_by_pmid ( $pmid );
		$this->load->view ( 'menu/menulist', $data );
	}
	
	/**
	 * 设置验证规则
	 */
	function _set_save_form_rules() {
		$rules = array (
				array (
						'field' => 'NAME',
						'label' => 'name',
						'rules' => 'trim|required'
				),
				array (
						'field' => 'content',
						'label' => 'content',
						'rules' => 'trim|required'
				)
		);
		//$this->form_validation->set_message ( 'required', 'field required erroe' );
		// $this->form_validation->set_message('trim', '不能为空');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // 去掉界定符号
		$this->form_validation->set_rules ( $rules );
	}
}
