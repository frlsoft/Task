<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 角色模型
 *
 * @author Administrator
 *        
 */
class Role_model extends CI_Model {
	const TBL_YG_PROJECT = 'yg_role';
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	
	/**
	 *
	 * @access public
	 * @param $data array        	
	 * @return bool 成功返回true, 失败返回false
	 */
	public function add_menu($data) {
		// 使用AR类完成插入操作
		return $this->db->insert ( self::TBL, $data );
	}
	
	/**
	 * 获取全部角色
	 */
	public function list_role() {
		$this->db->order_by ( "RMID", "asc" );
		$query = $this->db->get ( self::TBL );
		return $query->result_array ();
	}
	
	/**
	 * 显示菜单列表
	 *
	 * @param string $slug        	
	 */
	public function get_menu($slug = FALSE) {
		if ($slug === FALSE) {
			$query = $this->db->get ( self::TBL );
			return $query->result_array ();
		}
		
		$query = $this->db->get_where ( self::TBL, array (
				'slug' => $slug 
		) );
		return $query->row_array ();
	}
	
	/**
	 * 根据主键值返回菜单信息
	 */
	public function get_menu_by_pmid($pmid) {
		$cons = array (
				'p_mid' => $pmid  //$this->input->post ( 'mid' ) 
		);
		
		$query = $this->db->get_where ( self::TBL, $cons );
		
		if ($query->num_rows () > 0) {

			return $query->result_array ();
		} else {
			return 0;
		}
	}
	/**
	 * 保存角色
	 */
	public function set_role() {
		$this->load->helper ( 'url' );
		$url = url_title ( $this->input->post ( 'url' ), 'dash', TRUE );
		if ($this->input->post ( 'mid' )) {
			$mid = $this->input->post ( 'mid' );
		} else {
			$mid = 1;
		}
		$data = array (
				'rname' => $this->input->post ( 'name' ),
				//'url' => $this->input->post ( 'url' ),
				'gid' => $this->unit->guid ()
				//'p_mid' => $mid,
				//'ctime' => date ( 'Y-m-d G:i:s' ),
				//'lastmtime' => date ( 'Y-m-d G:i:s' ) 
		);		
		$ref = $this->db->insert ( self::TBL, $data );
		return $ref;
	}
	
	/**
	 * 更新菜单
	 */
	public function update_menu() {
		$data = array (
				'name' => $this->input->post ( 'name' ),
				'url' => $this->input->post ( 'url' ) 
		);
		$this->db->where ( 'uid', $this->input->post ( 'uid' ) );
		$this->db->update ( self::TBL, $data );
	}
}
?>