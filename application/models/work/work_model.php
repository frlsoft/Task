<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * Work 模型
 *
 * @package Package Name
 * @subpackage Subpackage
 * @category Category
 * @author fanrongli
 * @link http://example.com
 *      
 */
class Work_model extends CI_Model {
	/**
	 * (
	 * [uuid] => 1
	 * [stime] => 2013-12-19 15:07:25
	 * [ftime] => 2013-12-19 15:07:30
	 * [content] => 111
	 * [taskuuid] => uuuu
	 * [useruuid] => 11111
	 * [dayuuid] => 1111
	 * [ctime] => 2013-12-19 15:07:42
	 * )
	 */
	const TBL_WORK = 'yg_work';
	/**
	 * 按ID加载当日任务的work
	 *
	 * @param unknown $gid        	
	 * @return multitype:
	 */
	function load($gid) {
		if (! $gid) {
			return array ();
		}
		$useruuid = $this->session->userdata ( "GID" );
		$obj = $this->_getDayTask ( $gid );
		$query = $this->db->get_where ( self::TBL_WORK, array (
				'dayuuid' => $gid,
				'useruuid' => $useruuid 
		) );
		if ($row = $query->result_array ()) {
			//$row ['work_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	
	/**
	 * 创建新工作项
	 *
	 * @param unknown $gid        	
	 */
	function create($gid) {
		$gid = $this->input->post ( 'uuid' );
		$obj = $this->_getDayTask ( $gid );
		// my_print($obj);
		$data = array (
				'uuid' => $this->unit->guid (),
				'stime' => date ( 'Y-m-d G:i:s' ),
				// 'ftime' => date ( 'Y-m-d G:i:s' ),
				'content' => $this->unit->iconvpost ( $this->input->post ( 'content' ) ),
				'taskuuid' => $obj ['taskuuid'],
				'useruuid' => $obj ['useruuid'],
				'dayuuid' => $obj ['uuid'],
				'ctime' => date ( 'Y-m-d G:i:s' ) 
		);
		$query = $this->db->insert ( self::TBL_WORK, $data );
		if ($query) {
			return array (
					'flag' => '1' 
			);
		} else {
			return array (
					'flag' => '0' 
			);
		}
	}
	/**
	 * 获取yg_day_task数据消息
	 *
	 * @param unknown $gid        	
	 * @return multitype: unknown
	 */
	function _getDayTask($gid) {
		if (! $gid) {
			return array ();
		}
		$query = $this->db->get_where ( 'yg_day_task', array (
				'uuid' => $gid 
		) );
		if ($row = $query->row_array ()) {
			return $row;
		}
		return array ();
	}
	
	/**
	 * 测试获取数据结构
	 */
	function test() {
		$this->db->limit ( 1 );
		$query = $this->db->get ( self::TBL_WORK );
		my_print ( $query->row_array () );
	}
}
