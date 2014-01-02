<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * Blog 模型
 *
 * @package Package Name
 * @subpackage Subpackage
 * @category Category
 * @author administrator
 * @link http://example.com
 *      
 */
class Blog_model extends CI_Model {
	const USER_TABLE = 'userinfo';
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 返回所有用户数据
	 */
	public function get_all_userinfo() {
		// 封装查询
		$sql = "select * from userinfo";
		// $query = $this->db->query("select id,name from userinfo");
		$query = $this->db->query ( $sql );
		$str = $this->db->last_query ();//最后执行的SQL语句
		return $query->result ();
	}
	
	/**
	 * 按用户查询用户
	 *
	 * @param unknown $name        	
	 */
	public function get_userinfo_by_name($name) {
		// 封装查询
		$sql = "select * from userinfo where NAME = ?";
		$query = $this->db->query ( $sql, array (
				$name 
		) );

		return $query->result ();
	}
	/**
	 * 判断用户是否存在
	 *
	 * @param string $name        	
	 */
	public function exist_userinfo($name) {
		// 封装查询
		$sql = "select * from userinfo where NAME = ?";
		$query = $this->db->query ( $sql, array (
				$name 
		) );
		return $query->result ();
	}
}