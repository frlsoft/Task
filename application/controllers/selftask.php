<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 用户单人任务控制器
 *
 * @author FanRongli
 * @since 2013年12月19日
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
	 * 默认方法屏蔽入口
	 */
	function index() {
		echo '非法访问';
		exit ();
	}
	
	/**
	 * 加载个人全部任务数据
	 */
	function loadMyTask() {
		$data ['tasks'] = $this->selftask_model->loadMyTask ();
		
		$data ['status'] = array (
				'100010' => '已完成',
				'100020' => '进行中' 
		);
		//my_print ( $data );
		$this->load->view ( 'selftask/list', $data );
	}
	
	/**
	 * 按查询条件查询个人任务数据
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
	 * 加载work数据按用户信息
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