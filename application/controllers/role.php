<?php
/**
 * ��ɫ������
 * @author Administrator
 *
 */
class Role extends CI_Controller {
	//
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		//
		$sessionKey = $this->session->all_userdata ();
		if (! array_key_exists ( 'NAME', $sessionKey )) {
			exit ( '��ʱ���µ�½' );
		}
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'role_model' );
	}
	
	/**
	 * Ĭ�Ϸ���
	 */
	public function index() {
		$data = array (
				'goto' => '1',
				'message' => 'error' 
		);
		show_message1 ( 'don access ','inn/111/111' );
	}
	
	/**
	 */
	public function addRole() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		//
		$this->form_validation->set_rules ( 'name', '��ɫ����', 'required' );
		
		if ($this->form_validation->run () === FALSE) { //
			$this->load->view ( 'role/add' );
		} else { // form
			$data = $this->role_model->set_role ();
			if ($data) {
				$this->load->view ( 'role/success', $data );
			} else {
				$this->load->view ( 'fail', $data );
			}
		}
	}
	
	/**
	 *
	 * @param string $menuid        	
	 */
	public function listRole($menuid = FALSE) {
		if ($menuid === FALSE) {
			$data ['roles'] = $this->role_model->list_role ();
			$this->load->view ( 'role/list', $data );
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
}