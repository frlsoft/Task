<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * Blog ģ��
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
	 * ���������û�����
	 */
	public function get_all_userinfo() {
		// ��װ��ѯ
		$sql = "select * from userinfo";
		// $query = $this->db->query("select id,name from userinfo");
		$query = $this->db->query ( $sql );
		$str = $this->db->last_query ();//���ִ�е�SQL���
		return $query->result ();
	}
	
	/**
	 * ���û���ѯ�û�
	 *
	 * @param unknown $name        	
	 */
	public function get_userinfo_by_name($name) {
		// ��װ��ѯ
		$sql = "select * from userinfo where NAME = ?";
		$query = $this->db->query ( $sql, array (
				$name 
		) );

		return $query->result ();
	}
	/**
	 * �ж��û��Ƿ����
	 *
	 * @param string $name        	
	 */
	public function exist_userinfo($name) {
		// ��װ��ѯ
		$sql = "select * from userinfo where NAME = ?";
		$query = $this->db->query ( $sql, array (
				$name 
		) );
		return $query->result ();
	}
}