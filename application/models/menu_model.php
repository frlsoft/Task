<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 *
 * @author Administrator
 *        
 */
class Menu_model extends CI_Model {
	const TBL_YG_MENU = 'yg_menu';
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	
	/**
	 * ��ȡһ������
	 *
	 * @param unknown $id        	
	 */
	function load($gid) {
		if (! $gid) {
			return array ();
		}
		$query = $this->db->get_where ( self::TBL_YG_MENU, array (
				'uid' => $gid 
		) );
		if ($row = $query->row_array ()) {
			$row ['menu_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	
	/**
	 *
	 * @access public
	 * @param $data array        	
	 * @return bool �ɹ�����true, ʧ�ܷ���false
	 */
	public function add_menu($data) {
		// ʹ��AR����ɲ������
		return $this->db->insert ( self::TBL_YG_MENU, $data );
	}
	
	/**
	 * ��ȡȫ���˵�
	 */
	public function list_menu() {
		$this->db->order_by ( "MID", "asc" );
		$query = $this->db->get ( self::TBL_YG_MENU );
		return $query->result_array ();
	}
	
	/**
	 * ��ʾ�˵��б�
	 *
	 * @param string $slug        	
	 */
	public function get_menu($slug = FALSE) {
		if ($slug === FALSE) {
			$query = $this->db->get ( self::TBL_YG_MENU );
			return $query->result_array ();
		}
		
		$query = $this->db->get_where ( self::TBL_YG_MENU, array (
				'slug' => $slug 
		) );
		return $query->row_array ();
	}
	
	/**
	 * ��������ֵ���ز˵���Ϣ
	 */
	public function get_menu_by_pmid($pmid) {
		$cons = array (
				'p_mid' => $pmid 
		);
		$query = $this->db->get_where ( self::TBL_YG_MENU, $cons );
		if ($query->num_rows () > 0) {
			return $query->result_array ();
		} else {
			return 0;
		}
	}
	/**
	 * ����˵�
	 */
	public function set_menu() {
		$this->load->helper ( 'url' );
		$url = url_title ( $this->input->post ( 'url' ), 'dash', TRUE );
		if ($this->input->post ( 'mid' )) {
			$mid = $this->input->post ( 'mid' );
			$this->db->select ( "levels" );
			$query = $this->db->get ( self::TBL_YG_MENU, 1, 1 );
			
			$levels = $query->row ()->levels + 1;
		} else {
			$mid = 1;
			$levels = 0;
		}
		$data = array (
				'name' => $this->input->post ( 'name' ),
				'url' => $this->input->post ( 'url' ),
				'uid' => $this->unit->guid (),
				'p_mid' => $mid,
				'ctime' => date ( 'Y-m-d G:i:s' ),
				'lastmtime' => date ( 'Y-m-d G:i:s' ),
				'isroot' => $this->input->post ( 'isroot' ) ? '1' : '0',
				'content' => $this->input->post ( 'content' ),
				'levels' => $levels 
		);
		$ref = $this->db->insert ( self::TBL_YG_MENU, $data );
		$sql = "UPDATE YG_MENU SET M_MID=MID";
		$this->db->query ( $sql );
		return $ref;
	}
	
	/**
	 * ���²˵�
	 */
	public function update_menu() {
		$data = array (
				'name' => $this->input->post ( 'name' ),
				'url' => $this->input->post ( 'url' ) 
		);
		$this->db->where ( 'uid', $this->input->post ( 'uid' ) );
		$this->db->update ( self::TBL_YG_MENU, $data );
	}
	// ////////////////////////////////////////////////////////
	/**
	 */
	function update() {
		if (true) {
			$data = array (
					'name' => $this->unit->iconvpost ( $this->input->post ( 'NAME' ) ),
					'url' =>  $this->input->post ( 'URL' ),
					'content' => $this->unit->iconvpost ( $this->input->post ( 'content' ) ) ,
					'ISSTOP' => $this->unit->iconvpost ( $this->input->post ( 'ISSTOP' ) )?'1':'0'
			// 'orgid' => $this->input->post ( 'org_set' ),
			// 'yhbh' => $this->input->post ( 'yhbh' ),
			// 'createtime' => date ( 'Y-m-d G:i:s' )
						);
			$this->db->where ( 'uid', $this->input->post ( 'gid' ) );
			$query = $this->db->update ( self::TBL_YG_MENU, $data );
			echo $this->db->last_query();
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
}
?>