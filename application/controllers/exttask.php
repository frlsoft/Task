<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * �����ȡ
 *
 * @author Administrator
 *        
 */
class Exttask extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->model ( 'task/task_model' );
	}
	
	/**
	 * ��ʼ����ҳ��
	 */
	public function index() {
		echo '�Ƿ�����';
		exit ();
	}
	public function console() {
		$this->load->view ( 'task/exttask' );
	}
	/**
	 * �ֹ���ȡ�û�����
	 */
	function manualExtract() {
		echo '��ȡ����ʼ����ȡ����yg_do_task�����п�ʼʱ�䵫�޽���ʱ������񴴽���yg_do_task��';
		$data ['message'] = $this->task_model->exttask ();
	}
	
	/**
	 * �Զ���ʱ�������ȡȫ���û�����ʱ������Ϊÿ���賿00:10
	 */
	function autoExtract() {
		echo '�Զ���ʱ�������ȡȫ���û�����,��ȡ����yg_do_task�����п�ʼʱ�䵫�޽���ʱ������񴴽���yg_do_task��';
		$data ['message'] = $this->task_model->autoExttask ();
	}
	
	/**
	 * �Զ�����ÿ���û�Ϊ�ֶ��ύ���������ݣ���ʱ������Ϊ�����賿23:00
	 */
	function autoRecover() {
	}
	/**
	 * ���ö�ʱ��
	 */
	function setTimer() {
		echo 'timer';
		$this->db->insert ( 'yg_role', array (
				'RNAME' => 'TET',
				'GID' => '111' 
		) );
	}
}

/* End of file Exttask.php */
/* Location: ./application/controllers/Exttask.php */