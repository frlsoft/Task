<?php
/**
 * 个人任务模型
 * @author Administrator
 *
 */
class Selftask_model extends CI_Model {
	const TBL_DAY_TASK = 'yg_day_task';
	private $data = array ();
	/**
	 * 构造，初始化数据
	 */
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	/**
	 * 获取一条数据
	 *
	 * @param unknown $id        	
	 */
	function load($gid) {
		if (! $gid) {
			return array ();
		}
		$query = $this->db->get_where ( self::TBL_DAY_TASK, array (
				'uuid' => $gid 
		) );
		// echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			$row ['task_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	public function loadMyTask() {
		$useruuid = $this->session->userdata ( "GID" );
		$this->db->where ( 'useruuid', $useruuid );
		$this->db->order_by ( "ctime", "desc" );
		$query = $this->db->get ( self::TBL_DAY_TASK );
		if ($query->result_array ()) {
			foreach ( $query->result_array () as $key ) {
				if ($key ['starttime'] && $key ['finishtime']) {//都不为空时装填为:已完成
					$key ['status'] = '100010';
				} else {
					$key ['status'] = '100020';//进行中
				}
				$row [] = $key;
			}
			return $row;
		}
		return array ();
	}
	function finishTask() {
		$uuid = $this->unit->iconvpost ( $this->input->post ( 'uuid' ) );
		// var_dump(empty($uuid));
		if (empty ( $uuid )) {
			return array (
					'flag' => '0',
					'info' => 'arg is null' 
			);
		}
		
		$this->db->where ( 'uuid', $uuid );
		$this->db->where ( 'finishtime is null', null );
		$query = $this->db->update ( self::TBL_DAY_TASK, array (
				'finishtime' => date ( 'Y-m-d G:i:s' ) 
		) );
		if ($query) {
			return array (
					'flag' => '1',
					'info' => 'success' 
			);
		} else {
			return array (
					'flag' => '0',
					'info' => 'error' 
			);
		}
	}
}