<?php
class Portal_model extends CI_Model {
	var $username;
	var $password;
	const TBL_TASK = 'yg_user';
	const TBL_MENU = 'YG_MENU';
	const TBL_USER_ROLE = 'YG_USER_ROLE';
	const TBL_ROLE_MENU = 'yg_role_menu';
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	/**
	 * 判断用户是否存在
	 */
	public function user_exists() {
		$flag = FALSE;
		$data = array (
				'name' => $this->input->post ( 'username' ),
				'pwd' => md5 ( $this->input->post ( 'upassword' ) ) 
		);
		$this->db->select ( 'u.*' );
		$this->db->from ( 'yg_user as u' );
		$this->db->join ( 'yg_org as o', 'u.orgid = o.gid', 'left outer' );
		$this->db->where ( $data );
		// $this->db->order_by ( 'o.gid DESC' );
		$query = $this->db->get ();
		// 给出组织机构数据
		
		if ($query->num_rows () > 0) {
			$flag = TRUE;
			$user = $query->row ();
			// print_r($user);
			$this->session->set_userdata ( $user ); // 放入Session中
			$this->session->set_userdata ( 'logged_in', TRUE ); // 放入Session中
			$ref = array (
					'flag' => 1,
					'info' => '登陆成功' 
			);
		} else {
			$ref = array (
					'flag' => '0',
					'info' => 'user name or password error 户名或密码错误'  //户名或密码错误
			); 
		}		
		return $ref;
	}

	/**
	 * 获取用户菜单权限
	 *
	 * @return unknown
	 */
	public function get_user_menu() {
		$userid = $this->session->userdata ( 'GID' );
		$data = array (
				'uid' => $userid 
		);
		$this->db->select ( "roleid" );
		$query = $this->db->get_where ( self::TBL_USER_ROLE, $data ); // 获取用户拥有的角色
		                                                              // echo $this->db->last_query();
		$roledata = $query->result_array ();
		foreach ( $roledata as $row ) {
			$par [] = $row ['roleid'];
		}
		
		// 获取角色的菜单信息
		$this->db->select ( "MENUID" );
		$this->db->where_in ( 'roleid', $par );
		$query = $this->db->get ( self::TBL_ROLE_MENU );
		unset ( $par );
		// 获取菜单信息
		$roledata = $query->result_array ();
		foreach ( $roledata as $row ) {
			$par [] = $row ['MENUID'];
		}
		// print_r($par);
		$this->db->where_in ( 'mid', $par );
		$query = $this->db->get ( self::TBL_MENU );
		// echo $this->db->last_query();
		// echo $this->unit->guid();
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