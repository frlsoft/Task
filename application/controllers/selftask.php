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
class Selftask extends CI_Controller {
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'task/task_model' );
		$this->load->model ( 'task/selftask_model' );
		$this->load->model ( 'work/work_model' );
		$this->load->model ( 'project_model' );
	}
	/**
	 * Ĭ�Ϸ����������
	 */
	function index() {
		echo '�Ƿ�����';
		exit ();
	}
	
	/**
	 * ���ظ���ȫ����������
	 */
	function loadMyTask() {
		$data ['tasks'] = $this->selftask_model->loadMyTask ();
		
		$data ['status'] = array (
				'100010' => '�����',
				'100020' => '������' 
		);
		//my_print ( $data );
		$this->load->view ( 'selftask/list', $data );
	}
	
	/**
	 * ����ѯ������ѯ������������
	 */
	function queryOwnTask() {
	}
	function edit() {
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['tasks'] = $this->selftask_model->load ( $gid );
		}
		// my_print ( $data );
		$this->load->view ( 'selftask/edit', $data );
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
		$data ['uuid'] = $gid;
		$this->load->view ( 'selftask/work', $data );
	}

	/**
	 * [add description]
	 */
	function add() {
		$this->edit ();
	}
	
	/**
	 * [finishTask description]
	 * @return [type] [description]
	 */
	function finishTask() {
		$data ['message'] = $this->selftask_model->finishTask ();
		echo JSON ( $data );
	}
}

?>