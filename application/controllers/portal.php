<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Portal extends CI_Controller {
	// ���캯��
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
				'title' => '��Ŀ����ϵͳ' 
		);
		$this->load->view ( 'login/index', $data );
	}
	
	/**
	 * �ж��û��Ƿ����
	 */
	function init() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// ��֤����
		$this->_set_save_form_rules ();
		if ($this->form_validation->run () === FALSE) { // ��֤ʧ�� ���ص�¼ҳ��
		                                                // $this->load->view ( 'portal' );
			$data ['message'] = array (
					'flag' => '0',
					'info' => validation_errors () 
			);
		} else { // form ��֤ͨ������֤���ݿ��Ƿ���ڴ��û�
			$data ['message'] = $this->portal_model->user_exists ();
			if ($data) {
				// ��ȡ�û��˵�Ȩ��
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
	 * ����������
	 */
	function main() {
		$data = $this->portal_model->get_user_menu ();
		// print_r($menu);
		$this->load->view ( 'main/main', $data );
	}
	function signin() {
	}
	/**
	 * ��ʼ�����top
	 */
	function top() {
		$data = $this->portal_model->get_user_menu ();
		$data ['userdata'] = $this->session->all_userdata ();
		$data ['orgs'] = $this->session->all_userdata ();
		// print_r($data);
		$this->load->view ( 'main/top', $data );
	}
	/**
	 * ��ʼ�����left
	 */
	function left($module = '0000000000') {
		// �����ݲ�����ȡ�˵�����
		// $menu ['menus'] = $this->portal_model->get_user_menu ();
		$menu ['menus'] = $this->module_model->get_modelu_menu ( $module );
		$menu ['model'] = $this->module_model->get_module_name ( $module );
		$this->load->view ( 'main/left', $menu );
	}
	function right_top() {
		$data ['modules'] = $this->module_model->get_user_module ();
		$data ['location'] = array (
				'��ҳ ��',
				'�û���Ϣ��',
				'������־' 
		);
		$this->load->view ( 'main/right_top', $data );
	}
	function right() {
		$this->load->view ( 'main/right' );
	}
	
	/**
	 * ��ʼ�����center
	 */
	function center() {
		$this->load->view ( 'center' );
	}
	
	/**
	 * �˳���ע��
	 */
	function loginOut() {
		$this->session->sess_destroy ();
		// header ( base_url () );
	}
	
	/**
	 * ������֤����
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
		// $this->form_validation->set_message('trim', '����Ϊ��');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // ȥ���綨����
		$this->form_validation->set_rules ( $rules );
	}
}

/* End of file portal.php */
/* Location: ./application/controllers/portal.php */