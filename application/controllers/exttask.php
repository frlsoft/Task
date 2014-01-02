<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 任务抽取
 *
 * @author Administrator
 *        
 */
class Exttask extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->model ( 'task/task_model' );
	}
	
	/**
	 * 初始化表单页面
	 */
	public function index() {
		echo '非法访问';
		exit ();
	}
	public function console() {
		$this->load->view ( 'task/exttask' );
	}
	/**
	 * 手工抽取用户任务
	 */
	function manualExtract() {
		echo '抽取任务开始，获取个人yg_do_task中已有开始时间但无结束时间的任务创建到yg_do_task中';
		$data ['message'] = $this->task_model->exttask ();
	}
	
	/**
	 * 自动定时器任务抽取全部用户任务定时器设置为每天凌晨00:10
	 */
	function autoExtract() {
		echo '自动定时器任务抽取全部用户任务,获取个人yg_do_task中已有开始时间但无结束时间的任务创建到yg_do_task中';
		$data ['message'] = $this->task_model->autoExttask ();
	}
	
	/**
	 * 自动回收每天用户为手动提交的任务数据，定时器设置为当天凌晨23:00
	 */
	function autoRecover() {
	}
	/**
	 * 设置定时器
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