<?php
/**
 * 组织机构
 * @author Administrator
 *
 */
class Org_model extends CI_Model {
	const TBL_ORG = 'yg_org';
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
		$query = $this->db->get_where ( self::TBL_ORG, array (
				'GID' => $gid 
		) );
		//echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			$row ['org__list'] = $query->result_array ();			
			return $row;
		}
		return array ();
	}

	/**
	 * 结果集
	 *
	 *
	 */
	function find_org_sets()
	{
		$query = $this->db->get( self::TBL_ORG);
		$rows = array();
		foreach ($query->result_array() as $row){
			$this->db->select('COUNT(DISTINCT(id)) as total');
			$query_org = $this->db->get_where( self::TBL_ORG,array('GID' => $row['GID']));
			$row['org_count'] = 0;
			if ($row_org = $query_org->row_array()){
				$row['org_count'] = (int)$row_org['total'];
			}
			$rows[$row['GID']] = $row;
		}
		return $rows;
	}
	
	function find_org_by_gid($gid){
		
	}
}