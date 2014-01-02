<?php
class Login_model extends CI_Model {
	const TBL_TASK = 'yg_user';
	const TBL_MENU = 'YG_MENU';
	function __construct() {
		parent::__construct ();
		$this->load->library('unit');
	}
	/**
	 * 判断用户是否存在
	 */
	public function user_exists() {
		$flag = FALSE;
		$data = array (
				'name' => $this->input->post ( 'username' ),
				'pwd' => $this->input->post ( 'password' ) 
		);
		$query = $this->db->get_where ( self::TBL_USERINFO, $data );
		if ($query->num_rows () > 0) {
			$flag = TRUE;
			$user = $query->row ();
			//print_r($user);
			$this->session->set_userdata ( $user ); // 放入Session中
		}
		return $flag;
	}
	/**
	 * 获取用户菜单权限
	 *
	 * @return unknown
	 */
	public function get_user_menu() {
		$userid = $this->session->userdata ( 'NAME' );
		$data = array (
				'uid' => $userid 
		);		
		$query = $this->db->get_where ( self::TBL_MENU, $data );
		//echo  $this->db->last_query();
		//echo $this->unit->guid();
		/**
		 * foreach ($query->result_array() as $row)
		 * {
		 * echo $row['title'];
		 * echo $row['name'];
		 * echo $row['body'];
		 * }
		 * foreach ($query->result() as $row)
		 * {
		 * echo $row->title;
		 * echo $row->name;
		 * echo $row->body;
		 * }
		 */
		if ($query->num_rows () > 0) {
			$ref = array (
					'flag' => "TRUE",
					'result' => $query->result_array () 
			);
		} else {
			$ref = array (
					'flag' => "FALSE" 
			);
		}
		return $ref;
	}
}