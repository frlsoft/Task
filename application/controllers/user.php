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
		// ���ر���֤��
		$this->load->library ( 'form_validation' );
		// �����û�ģ��
		$this->load->model ( 'user/user_model' );
	}

	function index() {

	}

	/**
	 * ��ʾ�û��б�
	 */
	function listUser(){
		$data ['users'] = $this->user_model->find_users ();
		$data ['orgs'] = $this->org_model->find_org_sets ();
		$this->load->view ( 'user/list', $data );
	}

	/**
	 * ����û�
	 */
	function add() {
		$this->edit ();
	}
	/**
	 * �༭�û���Ϣ
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
			// Ԥ�����û�����
			$user_list = array ();
			foreach ( $data ['editing'] ['user_list'] as $key => $attr ) {
				$user_list [$attr ['ID']] ['ID'] = $attr ['ID'];
				$user_list [$attr ['ID']] ['NAME'] = $attr ['NAME'];
				$user_list [$attr ['ID']] ['GID'] = $attr ['GID'];
				$user_list [$attr ['ID']] ['SHOWNAME'] = $attr ['SHOWNAME'];
				$user_list [$attr ['ID']] ['ORGID'] = $attr ['ORGID'];
				$user_list [$attr ['ID']] ['yhbh'] = $attr ['yhbh'];
			}
		} else { // ׼�������� ��Ĭ������
			$data = array ();
		}
		
		$data ['orgs'] = $this->org_model->find_org_sets ();
		// װ����ͼ
		$this->load->view ( 'user/edit', $data );
	}
	/**
	 * �����û�����
	 */
	function save() {
		// �û�gid
		$gid = $this->input->post ( 'gid' );
		// ��֤����
		$this->_set_save_form_rules ();
		if (TRUE === $this->form_validation->run ()) {
			if ($gid) { // �༭
				$arr ['message'] = $this->user_model->update ();
			} else { // ����
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
	 * ɾ��
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
	 * ������֤����
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
		// $this->form_validation->set_message('trim', '����Ϊ��');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // ȥ���綨����
		$this->form_validation->set_rules ( $rules );
	}
}