<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * �û��������������
 *
 * @author FanRongli
 * @since 2013��12��19��
 * @version V1.2
 *          @
 *         
 */
class Work extends CI_Controller {
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'task/task_model' );
		$this->load->model ( 'task/selftask_model' );
		$this->load->model ( 'work/work_model' );
	}
	/**
	 * Ĭ�Ϸ����������
	 */
	function index() {
		$this->work_model->test ();
		echo '�Ƿ�����';
		exit ();
	}
	
	/**
	 * ����work���ݰ��û���Ϣ
	 */
	function load() {
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['works'] = $this->work_model->load ( $gid );
		}		
		$data ['uuid'] = $gid;
		$data ['finish'] = $params ['finish'];
		//my_print ( $data );
		$this->load->view ( 'work/list', $data );
	}
	
	/**
	 */
	function edit() {
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['tasks'] = $this->work_model->create ( $gid );
		}
		$data ['uuid'] = $gid;
		$this->load->view ( 'work/edit', $data );
	}
	/**
	 * ����work���ݰ��û���Ϣ
	 */
	function work() {
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['works'] = $this->work_model->load ( $gid );
		}
		
		$this->load->view ( 'selftask/work', $data );
	}
	/**
	 *
	 * @return multitype:string
	 */
	function save() {
		$gid = $this->input->post ( 'gid' );
		if ($gid) { // �༭
			$data ['message'] = $this->work_model->update ();
		} else { // ����
			$data ['message'] = $this->work_model->create ();
		}
		echo JSON ( $data );
	}
	function add() {
		$this->edit ();
	}
}

?>