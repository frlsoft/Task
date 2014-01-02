<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 项目模型
 * @author Administrator
 * @  
 */
class Project_model extends CI_Model {
	const TBL_YG_PROJECT = 'yg_project';
	public function __construct() {
		parent::__construct ();
		$this->
load->library ( 'unit' );
	}
	
	/**
	 *
	 * @param String $uuid        	
	 * @return multitype: array
	 */
	function load($uuid) {
		if (! $uuid) {
			return array ();
		}
		$query = $this->db->get_where ( self::TBL_YG_PROJECT, array (
				'uuid' => $uuid 
		) );
		// echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			$row ['project_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	
	/**
	 * 创建
	 */
	function create() {
		if (get_magic_quotes_gpc()) {
		  $content = stripslashes($this->unit->iconvpost ($this->input->post ( 'tcontent' )));
		}
		else {
  		  $content =$this->unit->iconvpost ( $this->input->post ( 'tcontent' ));
		}
		$data = array (
				'pname' => $this->unit->iconvpost ( $this->input->post ( 'pname' ) ),
				'planstime' => $this->input->post ( 'planstime' ),
				'planetime' => $this->input->post ( 'planetime' ),
				'pouuid' => $this->session->userdata ( 'GID' ),
				'cuseruuid' => $this->session->userdata ( 'GID' ),
				'orgid' => $this->input->post ( 'org_set' ),
				'ctime' => date ( 'Y-m-d G:i:s' ),
				'content' => $content,
				'uuid' => $this->unit->guid () 
		);
		$query = $this->db->insert ( self::TBL_YG_PROJECT, $data );		
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
	 * 结果集
	 */
	function find_org_sets() {
		$query = $this->db->get ( self::TBL_YG_PROJECT );
		$rows = array ();
		foreach ( $query->result_array () as $row ) {
			$this->db->select ( 'COUNT(DISTINCT(id)) as total' );
			$query_org = $this->db->get_where ( self::TBL_YG_PROJECT, array (
					'uuid' => $row ['uuid'] 
			) );
			$row ['pro_count'] = 0;
			if ($row_org = $query_org->row_array ()) {
				$row ['pro_count'] = ( int ) $row_org ['total'];
			}
			$rows [$row ['uuid']] = $row;
		}
		return $rows;
	}
	
	/**
	 *
	 * @param unknown $param        	
	 * @return multitype:unknown
	 */
	function find_projects($param = array()) {
		$this->db->from ( 'yg_project as p' );
		$this->db->join ( 'yg_user as u', 'p.cuseruuid = u.gid', 'left outer' );
		$this->db->order_by ( 'p.ctime DESC' );
		$query = $this->db->get ();
		$rows = array ();
		foreach ( $query->result_array () as $row ) {
			$rows [] = $row;
		}
		return $rows;
	}

	/**
	 *按用户获取所能参与的项目数据
	 * @return multitype: unknown
	 */
	function load_by_user() {
		// echo '简单输出';
		$orgid = $this->session->userdata ( 'ORGID' );
		$query = $this->db->get_where ( self::TBL_YG_PROJECT, array (
				'orgid' => $orgid 
		) );
		// echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			return $query->result_array ();
		}
		return array ();
	}

	/**
	 * 更新项目信息
	 * @param  [string] $uuid [项目uuid]
	 * @return [array]       [更新状态 1.成功，0.失败]
	 */
	function update($uuid) {
		$data = array (
				'pname' => $this->unit->iconvpost ( $this->input->post ( 'pname' ) ),
				'planstime' => $this->input->post ( 'planstime' ),
				'planetime' => $this->input->post ( 'planetime' ),
				'pouuid' => $this->session->userdata ( 'GID' ),
				'content' => $this->input->post ( 'content' ),
				// 'cuseruuid' => $this->session->userdata ( 'GID' ),
				'orgid' => $this->input->post ( 'org_set' ) 
		);	
		$this->db->where ( 'uuid', $this->input->post ( 'gid' ) );
		$query = $this->db->update ( self::TBL_YG_PROJECT, $data );
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
	 * 删除
	 *
	 * @param unknown $uuid        	
	 */
	function delete($uuid) {
		$this->db->where ( 'uuid', $uuid );
		return $this->db->delete ( self::TBL_YG_PROJECT );
	}
	
	// ===============================================================================
	/**
	 *
	 * @param unknown $options        	
	 */
	function count_projects($options) {
		$this->db->select ( 'COUNT(DISTINCT(a.uuid)) as total' );
		
		// $query = $this->_query_attributes($options);
		$this->db->from('yg_project as a');
		$query = $this->db->get ( );
		$total = 0;
		if ($row = $query->row_array ()) {
			$total = ( int ) $row ['total'];
		}
		return $total;
	}
}
?>