<?php
class User_model extends CI_Model {
	var $gid;
	const TBL_USERINFO = 'yg_user';
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
		$query = $this->db->get_where ( self::TBL_USERINFO, array (
				'GID' => $gid 
		) );
		// echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			$row ['user_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	/**
	 */
	function create() {
		$ref = $this->user_exits ();
		if ($ref ['flag']) {
			$data = array (
					'name' => $this->unit->iconvpost ( $this->input->post ( 'name' ) ),
					'pwd' => md5 ( $this->input->post ( 'password' ) ),
					'showname' => $this->unit->iconvpost ( $this->input->post ( 'showname' ) ),
					'orgid' => $this->input->post ( 'org_set' ),
					'yhbh' => $this->input->post ( 'yhbh' ),
					'createtime' => date ( 'Y-m-d G:i:s' ),
					'gid' => $this->unit->guid () 
			);
			$query = $this->db->insert ( self::TBL_USERINFO, $data );
			
			if ($query) {
				return array (
						'flag' => '1' 
				);
			} else {
				return array (
						'flag' => '0' 
				);
			}
		} else {
			return $ref;
		}
	}
	
	/**
	 */
	function update() {
		if (true) {
			$data = array (
					'name' => $this->unit->iconvpost ( $this->input->post ( 'name' ) ),
					'pwd' => md5 ( $this->input->post ( 'password' ) ),
					'showname' => $this->unit->iconvpost ( $this->input->post ( 'showname' ) ),
					'orgid' => $this->input->post ( 'org_set' ),
					'yhbh' => $this->input->post ( 'yhbh' ),
					'createtime' => date ( 'Y-m-d G:i:s' ) 
			);
			$this->db->where ( 'gid', $this->input->post ( 'gid' ) );
			$query = $this->db->update ( self::TBL_USERINFO, $data );
			
			if ($query) {
				return array (
						'flag' => '1' 
				);
			} else {
				return array (
						'flag' => '0' 
				);
			}
		} else {
			return $ref;
		}
	}
	/**
	 * 
	 * @param unknown $gid
	 */
	function delete($gid) {
		$this->db->where ( 'gid', $gid );
		return $this->db->delete ( self::TBL_USERINFO );
	}
	/**
	 *
	 * @return unknown multitype:
	 */
	function find_users() {
		$query = $this->db->get ( self::TBL_USERINFO );
		if ($row = $query->result_array ()) {
			return $row;
		}
		return array ();
	}
	/**
	 * 添加一个用户到数据库
	 *
	 * @return unknown
	 */
	function add_user() {
		$ref = $this->user_exits ();
		if ($ref ['flag']) {
			$data = array (
					'name' => $this->input->post ( 'username' ),
					'pwd' => md5 ( $this->input->post ( 'password' ) ),
					'showname' => $this->input->post ( 'username' ),
					'gid' => $this->unit->guid () 
			);
			$query = $this->db->insert ( self::TBL_USERINFO, $data );
		} else {
			return $ref;
		}
		return $ref ['data'] = $query;
	}
	
	/**
	 * 判断新增用户是否存在
	 *
	 * @return multitype:string
	 */
	public function user_exits() {
		$data = array (
				'name' => $this->input->post ( 'name' ),
				'yhbh' => $this->input->post ( 'yhbh' ) 
		);
		$query = $this->db->get_where ( self::TBL_USERINFO, $data );
		if ($query->num_rows () > 0) { // 用户或者编号存在
			$ref = array (
					'flag' => '0',
					'info' => 'user exists or yhbh exists' 
			);
		} else {
			$ref = array (
					'flag' => '1' 
			);
		}
		return $ref;
	}
	
	/**
	 * 返回用户列表
	 */
	function user_list() {
		$query = $this->db->get ( self::TBL_USERINFO );
		$row = array();
		foreach ($query->result_array() as $key){
			$row[$key['GID']] = $key;
		}
		return $row;
	}
	
	/**
	 * 查询用户信息按名字
	 */
	function user_by_name() {
	}
	function save() {
	}
}