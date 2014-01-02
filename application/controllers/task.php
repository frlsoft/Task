<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 任务处理控制器
 *
 * @author Administrator
 *        
 */
class Task extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'task/task_model' );
		$this->load->model ( 'project_model' );
	}
	
	/**
	 * 初始化表单页面
	 */
	public function index() {
		error_reporting ( 1 );
		$data ['tasks'] = $this->task_model->load_tasks ();
		$data ['orgs'] = $this->project_model->find_org_sets ();
		// my_print($data);
		$this->load->view ( 'task/list', $data );
	}

	/**
	 * 创建一个新任务
	 */
	public function add() {
		$this->edit ();
	}

	/**
	 * 编辑任务
	 * @return [array] [返回一个任务数组]
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
			// 预处理用户数据
			// $user_list = array ();
			// foreach ( $data ['editing'] ['user_list'] as $key => $attr ) {
			// $user_list [$attr ['ID']] ['ID'] = $attr ['ID'];
			// $user_list [$attr ['ID']] ['NAME'] = $attr ['NAME'];
			// $user_list [$attr ['ID']] ['GID'] = $attr ['GID'];
			// $user_list [$attr ['ID']] ['SHOWNAME'] = $attr ['SHOWNAME'];
			// $user_list [$attr ['ID']] ['ORGID'] = $attr ['ORGID'];
			// $user_list [$attr ['ID']] ['yhbh'] = $attr ['yhbh'];
			// }
		} else { // 准备空数据 及默认数据
			$data = array ();
		}
		$data ['projects'] = $this->project_model->load_by_user ();
		// my_print($data);
		$this->load->view ( 'task/edit', $data );
	}
	
	/**
	 * 数据保存
	 */
	function save() {
		$gid = $this->input->post ( 'gid' );
		if ($gid) { // 编辑
			$data ['message'] = $this->task_model->update ();
		} else { // 新增
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
			$gid = $params ['gid']; // 按ID获取已分配用户数据
			$data ['taskuser'] = $this->task_model->taskUser ( $gid );
			$data ['alluser'] = $this->user_model->user_list ( $gid );
		} else {
			// 加载空数据
			// $data ['editing'] = $this->user_model->load ( $gid );
			$data ['taskuser'] = $this->task_model->taskUser ( $gid );
			$data ['alluser'] = $this->user_model->user_list ( $gid );
		}
		// my_print ( $data );
		$this->load->view ( 'user/taskUser', $data );
	}

	/**
	 * 获取分配的数据
	 */
	function assginTask() {
		$params = $this->uri->uri_to_assoc ();
		// my_print ( $params );
		$data ['message'] = $this->task_model->assginTask ( $params );
		echo JSON ( $data );
	}
	/**
	 * 个人用户任务数据检索
	 */
	function userTaskList() {
		$data ['tasks'] = $this->task_model->load_tasks_by_user ();//检索分配表数据在查询主表数据关联
		$data ['orgs'] = $this->project_model->find_org_sets ();
		$data ['assgin'] = $this->task_model->load_assgin_task ();
		$data ['readed'] = array (
				'1' => '已读',
				'0' => '未读' 
		);
	    // my_print ( $data );
		$this->load->view ( 'task/usertask', $data );
	}
	/**
	 * 个人任务操作设置任务为已读状态，在下一步操作中可以设置任务的启动时间
	 */
	function usertaskop() {
		$params = $this->uri->uri_to_assoc ();
		$op = $params ['op'];
		$uuid = $params ['uuid'];
		// 设为已读状态
		$task = $this->_taskReaded ( $uuid );
		// 预览任务
		// 设置任务启动时间
		// $this->_setTaskStartTime ( $uuid );
		$data ['editing'] = $task;
		// $data ['projects'] = $this->project_model->load_by_user ();
		$data ['projects'] = $this->project_model->find_org_sets ();
		$data ['assginuuid'] = $uuid;
		// my_print ( $data );
		$this->load->view ( 'task/preview', $data );
	}
	/**
	 * 手工设置任务启动日期
	 */
	function setTaskStartTime() {
		$params = $this->uri->uri_to_assoc ();
		$uuid = $params ['uuid'];
		$data = $this->_setTaskStartTime ( $uuid );
		echo JSON ( $data );
	}
	/**
	 * 手工设置任务结束日期
	 */
	function setTaskFinishTime() {
		$params = $this->uri->uri_to_assoc ();
		$uuid = $params ['uuid'];
		$data = $this->_setTaskFinishTime ( $uuid );
		echo JSON ( $data );
	}
	/**
	 * 抽取用户任务
	 */
	function exttask() {
		echo '抽取任务开始，获取个人yg_do_task中已有开始时间但无结束时间的任务创建到yg_do_task中';
		$data ['message'] = $this->task_model->exttask ();
		// my_print ( $data );
	}
	/**
	 * 标记任务为已读状态
	 * @param  [type] $uuid [description]
	 * @return [type]       [description]
	 */
	function _taskReaded($uuid) {
		$data ['editing'] = $this->task_model->setTaskReaded ( $uuid );
		$this->_getTaskToWork ( $uuid );
		return $data ['editing'];
	}

	/**
	 * 标记完已读状态后将任务创建在个人工作空间，此时创建的任务并不能通过定时器自定调用生成，
	 *
	 * @param unknown $uuid        	
	 */
	function _getTaskToWork($uuid) {
		$data ['message'] = $this->task_model->getTaskToWork ( $uuid );
		// my_print ( $data );
	}

	/**
	 * 设置任务的启动时间
	 *
	 * @param unknown $uuid        	
	 */
	function _setTaskStartTime($uuid) {
		$data ['message'] = $this->task_model->setTaskStartTime ( $uuid );
		return $data;
	}
	
	/**
	 * 设置任务的结束时间时间
	 *
	 * @param unknown $uuid        	
	 */
	function _setTaskFinishTime($uuid) {
		$data ['message'] = $this->task_model->setTaskFinishTime ( $uuid );
		return $data;
	}

	/**
	 * 审核任务根据每项工作完成质量进行评分
	 * @param  string $param [description]
	 * @return [type]        [description]
	 */
	public function auditTask($param = ''){
		$data['task']=$this->task_model->auditTask();
		$data['taskassgin']=$this->task_model->auditTask();
		$this->load->view('task/audit', $data);
	}
	
	/**
	 * 任务审核
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