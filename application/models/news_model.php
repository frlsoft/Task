<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 *
 * @author Administrator
 *        
 */
class News_model extends CI_Model {
	const TBL_YG_PROJECT = 'news';
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 *
	 * @access public
	 * @param $data array        	
	 * @return bool 成功返回true, 失败返回false
	 */
	public function add_news($data) {
		// 使用AR类完成插入操作
		return $this->db->insert ( self::TBL, $data );
	}
	/**
	 */
	public function list_news() {
		$query = $this->db->get ( self::TBL );
		return $query->result_array ();
	}
	
	/**
	 * 显示新闻列表
	 * 
	 * @param string $slug        	
	 */
	public function get_news($slug = FALSE) {
		if ($slug === FALSE) {
			$query = $this->db->get ( 'news' );
			return $query->result_array ();
		}
		
		$query = $this->db->get_where ( 'news', array (
				'slug' => $slug 
		) );
		return $query->row_array ();
	}
	
	/**
	 * 保存新闻
	 */
	public function set_news() {
		$this->load->helper ( 'url' );
		
		$slug = url_title ( $this->input->post ( 'title' ), 'dash', TRUE );
		
		$data = array (
				'title' => $this->input->post ( 'title' ),
				'slug' => $slug,
				'text' => $this->input->post ( 'text' ) 
		);
		
		return $this->db->insert ( 'news', $data );
	}
}
?>