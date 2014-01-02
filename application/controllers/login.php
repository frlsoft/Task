<?php
class Login extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->model ( 'login/login_model' );
	}
	/**
	 * Ĭ�ϵĵ�¼ҳ��
	 */
	public function index() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		$this->load->view ( 'login/index' );
	}
	
	/**
	 * �ж��û��Ƿ����
	 */
	public function check_user_login_info() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// �û�����������֤
		$this->form_validation->set_rules ( 'username', '�û���', 'required' );
		$this->form_validation->set_rules ( 'password', '����', 'required' );
		
		if ($this->form_validation->run () === FALSE) { // ��֤ʧ�� ���ص�¼ҳ��
			$this->load->view ( 'login/index' );
		} else { // form ��֤ͨ������֤���ݿ��Ƿ���ڴ��û�
			$data = $this->login_model->user_exists ();
			if ($data) {
				// ��ȡ�û��˵�Ȩ��
				$menu =  $this->login_model->get_user_menu();
				//print_r($menu);
				$this->load->view ( 'main', $menu );
			} else {
				$this->load->view ( 'fail' );
			}
		}
	}
}