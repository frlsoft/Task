<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * �����������
 *
 * @author Administrator
 *        
 */
class Task extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'task/task_model' );
		$this->load->model ( 'project_model' );
	}
	
	/**
	 * ��ʼ����ҳ��
	 */
	public function index() {
		error_reporting ( 1 );
		$data ['tasks'] = $this->task_model->load_tasks ();
		$data ['orgs'] = $this->project_model->find_org_sets ();
		// my_print($data);
		$this->load->view ( 'task/list', $data );
	}

	/**
	 * ����һ��������
	 */
	public function add() {
		$this->edit ();
	}

	/**
	 * �༭����
	 * @return [array] [����һ����������]
	 */
	public function edit() {
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['editing'] = $this->task_model->load ( $gid );
			if (! $data ['editing']) {
				return array (
						'gid:' . $gid,
						'user' 
				);
			}
			// Ԥ�����û�����
			// $user_list = array ();
			// foreach ( $data ['editing'] ['user_list'] as $key => $attr ) {
			// $user_list [$attr ['ID']] ['ID'] = $attr ['ID'];
			// $user_list [$attr ['ID']] ['NAME'] = $attr ['NAME'];
			// $user_list [$attr ['ID']] ['GID'] = $attr ['GID'];
			// $user_list [$attr ['ID']] ['SHOWNAME'] = $attr ['SHOWNAME'];
			// $user_list [$attr ['ID']] ['ORGID'] = $attr ['ORGID'];
			// $user_list [$attr ['ID']] ['yhbh'] = $attr ['yhbh'];
			// }
		} else { // ׼�������� ��Ĭ������
			$data = array ();
		}
		$data ['projects'] = $this->project_model->load_by_user ();
		// my_print($data);
		$this->load->view ( 'task/edit', $data );
	}
	
	/**
	 * ���ݱ���
	 */
	function save() {
		$gid = $this->input->post ( 'gid' );
		if ($gid) { // �༭
			$data ['message'] = $this->task_model->update ();
		} else { // ����
			$data ['message'] = $this->task_model->create ();
		}
		echo JSON ( $data );
	}

    /**
     * [taskUser description]
     * @return [type] [description]
     */
	function taskUser() {
		$data = array ();
		$params = $this->uri->uri_to_assoc ();
		if (! empty ( $params ['gid'] )) {
			$this->load->model ( 'user/user_model' );
			$gid = $params ['gid']; // ��ID��ȡ�ѷ����û�����
			$data ['taskuser'] = $this->task_model->taskUser ( $gid );
			$data ['alluser'] = $this->user_model->user_list ( $gid );
		} else {
			// ���ؿ�����
			// $data ['editing'] = $this->user_model->load ( $gid );
			$data ['taskuser'] = $this->task_model->taskUser ( $gid );
			$data ['alluser'] = $this->user_model->user_list ( $gid );
		}
		// my_print ( $data );
		$this->load->view ( 'user/taskUser', $data );
	}

	/**
	 * ��ȡ���������
	 */
	function assginTask() {
		$params = $this->uri->uri_to_assoc ();
		// my_print ( $params );
		$data ['message'] = $this->task_model->assginTask ( $params );
		echo JSON ( $data );
	}
	/**
	 * �����û��������ݼ���
	 */
	function userTaskList() {
		$data ['tasks'] = $this->task_model->load_tasks_by_user ();//��������������ڲ�ѯ�������ݹ���
		$data ['orgs'] = $this->project_model->find_org_sets ();
		$data ['assgin'] = $this->task_model->load_assgin_task ();
		$data ['readed'] = array (
				'1' => '�Ѷ�',
				'0' => 'δ��' 
		);
	    // my_print ( $data );
		$this->load->view ( 'task/usertask', $data );
	}
	/**
	 * �������������������Ϊ�Ѷ�״̬������һ�������п����������������ʱ��
	 */
	function usertaskop() {
		$params = $this->uri->uri_to_assoc ();
		$op = $params ['op'];
		$uuid = $params ['uuid'];
		// ��Ϊ�Ѷ�״̬
		$task = $this->_taskReaded ( $uuid );
		// Ԥ������
		// ������������ʱ��
		// $this->_setTaskStartTime ( $uuid );
		$data ['editing'] = $task;
		// $data ['projects'] = $this->project_model->load_by_user ();
		$data ['projects'] = $this->project_model->find_org_sets ();
		$data ['assginuuid'] = $uuid;
		// my_print ( $data );
		$this->load->view ( 'task/preview', $data );
	}
	/**
	 * �ֹ�����������������
	 */
	function setTaskStartTime() {
		$params = $this->uri->uri_to_assoc ();
		$uuid = $params ['uuid'];
		$data = $this->_setTaskStartTime ( $uuid );
		echo JSON ( $data );
	}
	/**
	 * �ֹ����������������
	 */
	function setTaskFinishTime() {
		$params = $this->uri->uri_to_assoc ();
		$uuid = $params ['uuid'];
		$data = $this->_setTaskFinishTime ( $uuid );
		echo JSON ( $data );
	}
	/**
	 * ��ȡ�û�����
	 */
	function exttask() {
		echo '��ȡ����ʼ����ȡ����yg_do_task�����п�ʼʱ�䵫�޽���ʱ������񴴽���yg_do_task��';
		$data ['message'] = $this->task_model->exttask ();
		// my_print ( $data );
	}
	/**
	 * �������Ϊ�Ѷ�״̬
	 * @param  [type] $uuid [description]
	 * @return [type]       [description]
	 */
	function _taskReaded($uuid) {
		$data ['editing'] = $this->task_model->setTaskReaded ( $uuid );
		$this->_getTaskToWork ( $uuid );
		return $data ['editing'];
	}

	/**
	 * ������Ѷ�״̬�����񴴽��ڸ��˹����ռ䣬��ʱ���������񲢲���ͨ����ʱ���Զ��������ɣ�
	 *
	 * @param unknown $uuid        	
	 */
	function _getTaskToWork($uuid) {
		$data ['message'] = $this->task_model->getTaskToWork ( $uuid );
		// my_print ( $data );
	}

	/**
	 * �������������ʱ��
	 *
	 * @param unknown $uuid        	
	 */
	function _setTaskStartTime($uuid) {
		$data ['message'] = $this->task_model->setTaskStartTime ( $uuid );
		return $data;
	}
	
	/**
	 * ��������Ľ���ʱ��ʱ��
	 *
	 * @param unknown $uuid        	
	 */
	function _setTaskFinishTime($uuid) {
		$data ['message'] = $this->task_model->setTaskFinishTime ( $uuid );
		return $data;
	}

	/**
	 * ����������ÿ������������������
	 * @param  string $param [description]
	 * @return [type]        [description]
	 */
	public function auditTask($param = ''){
		$data['task']=$this->task_model->auditTask();
		$data['taskassgin']=$this->task_model->auditTask();
		$this->load->view('task/audit', $data);
	}
	
	/**
	 * �������
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function auditList(){
		$data['tasks'] = $this->task_model->auditWatiTask();
		$data ['projects'] = $this->project_model->load_by_user ();
		// my_print($data);
		$this->load->view('task/audit', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */