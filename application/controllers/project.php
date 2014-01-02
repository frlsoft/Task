<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * ��Ŀ���������
 *
 * @author Administrator
 *        
 */
class Project extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		if (! $this->session->userdata ( 'logged_in' )) {
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
		$this->load->model ( 'project_model' );
		// echo "<pre>";
	}
	
	/**
	 * ��ʼ����ҳ��
	 */
	function index() {
		$data = array ();
		$options = '';
		// ��ҳ����
		$per_page = 15;
		$data ['total_rows'] = $this->project_model->count_projects ( $options );
		// ��ҳ��
		$data ['total_pages'] = ceil ( $data ['total_rows'] / $per_page );
		// ��ǰҳ��input��
		$data ['page'] = $page_offset + 1;
		$data ['page'] = ($data ['page'] > $data ['total_pages'] && $data ['total_pages'] > 0) ? $data ['total_pages'] : $data ['page'];
		$data ['projects'] = $this->project_model->find_projects ();
		$data ['orgs'] = $this->org_model->find_org_sets ();
		//my_print ( $data );
		$this->load->view ( 'project/list', $data );
	}
	
	/**
	 * ��������
	 */
	function add() {
		$this->edit ();
	}
	
	/**
	 * �༭����
	 */
	function edit() {
		$data ['title'] = '��������Ŀ';
		$data ['projects'] = array ();
		$params = $this->uri->uri_to_assoc ();
		// echo $params ['gid'];
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['editing'] = $this->project_model->load ( $gid );
			if (! $data ['editing']) {
				return array (
						'gid:' . $gid,
						'user' 
				);
			}
			// Ԥ�����û�����
			$projects_list = array ();
			foreach ( $data ['editing'] ['projects_list'] as $key => $attr ) {
				$projects_list [$attr ['ID']] ['id'] = $attr ['id'];
				$projects_list [$attr ['ID']] ['uuid'] = $attr ['uuid'];
				$projects_list [$attr ['ID']] ['pname'] = $attr ['pname'];
				$projects_list [$attr ['ID']] ['ctime'] = $attr ['ctime'];
				$projects_list [$attr ['ID']] ['ppath'] = $attr ['ppath'];
				$projects_list [$attr ['ID']] ['pouuid'] = $attr ['pouuid'];
				$projects_list [$attr ['ID']] ['planstime'] = $attr ['planstime'];
				$projects_list [$attr ['ID']] ['planetime'] = $attr ['planetime'];
				$projects_list [$attr ['ID']] ['cuseruuid'] = $attr ['cuseruuid'];
				$projects_list [$attr ['ID']] ['orgid'] = $attr ['orgid'];
			}
		/**
		 * id int not null auto_increment comment '����',
		 * uuid varchar(50) comment '�Զ�������',
		 * pname varchar(100) comment '��Ŀ����',
		 * ctime datetime comment '����ʱ��',
		 * ppath varchar(50) comment '��Ŀ�ĵ�����·��',
		 * pouuid varchar(50) comment '��Ŀ����uuid',
		 * planstime datetime comment '��Ŀ�ƻ���ʼʱ��',
		 * planetime datetime comment '��Ŀ�ƻ�����ʱ��',
		 * cuseruuid varchar(50) comment '��Ŀ������UUID',
		 * orgid varchar(50) comment '������֯��������'
		 */
		} else { // ׼�������� ��Ĭ������
			$data = array ();
		}
		$data ['orgs'] = $this->org_model->find_org_sets ();
		$this->load->view ( 'project/edit', $data );
	}
	
	/**
	 * ��������
	 */
	function save() {
		// �û�gid
		$gid = $this->input->post ( 'gid' );
		// ��֤����
		$this->_set_save_form_rules ();
		if (TRUE === $this->form_validation->run ()) {
			if ($gid) { // �༭
				$arr ['message'] = $this->project_model->update ();
			} else { // ����
				$arr ['message'] = $this->project_model->create ();
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
	 * ������֤����
	 */
	function _set_save_form_rules() {
		$rules = array (
				array (
						'field' => 'pname',
						'label' => 'pname',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'planstime',
						'label' => 'planstime',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'planetime',
						'label' => 'planetime',
						'rules' => 'trim|required' 
				) 
		);
		$this->form_validation->set_message ( 'required', 'field required erroe' );
		// $this->form_validation->set_message('trim', '����Ϊ��');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // ȥ���綨����
		$this->form_validation->set_rules ( $rules );
	}
}

/* End of file Project.php */
/* Location: ./application/controllers/Project.php */