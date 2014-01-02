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
	 * @return bool �ɹ�����true, ʧ�ܷ���false
	 */
	public function add_news($data) {
		// ʹ��AR����ɲ������
		return $this->db->insert ( self::TBL, $data );
	}
	/**
	 */
	public function list_news() {
		$query = $this->db->get ( self::TBL );
		return $query->result_array ();
	}
	
	/**
	 * ��ʾ�����б�
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
	 * ��������
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