<?php
class Module_model extends CI_Model {
	const TBL_USER_MODULE = 'yg_user_module';
	const TBL_MODULE = 'yg_module';
	const TBL_MODULE_MENU = 'yg_module_menu';
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	
	public function module_list(){
		$query = $this->db->get ( self::TBL_MODULE );
		return $query->result_array();
	}
	
	/**
	 * 按uuid 检索模块信息
	 * @param unknown $uuid
	 * @return multitype:|unknown
	 */
	public function load($uuid){
		if (! $uuid) {
			return array ();
		}
		$query = $this->db->get_where ( self::TBL_MODULE, array (
				'uuid' => $uuid
		) );
		echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			$row ['module_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	
	/**
	 */
	function create() {
	if (true) {
	$data = array (
			'mname' => $this->unit->iconvpost ( $this->input->post ( 'mname' ) ),
			'ctime' => date ( 'Y-m-d G:i:s' ),
			'uuid' => $this->unit->guid ()
	);
	$query = $this->db->insert ( self::TBL_MODULE, $data );
		
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
		return array (
				'flag' => '0'
		);
	}
	}
	/**
	 * 获取用户模块权限
	 */
	public function get_user_modulea() {
		$flag = FALSE;
		$data = array (
				'name' => $this->input->post ( 'username' ),
				'pwd' => md5 ( $this->input->post ( 'upassword' ) ) 
		);
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
	 * 获取用户模块权限
	 */
	public function get_user_module() {
		$userid = $this->session->userdata ( 'GID' );
		//print_r($this->session->all_userdata ());
		$data = array (
				'uuuid' => $userid 
		);
		//$query = $this->db->get_where ( self::TBL_USER_MODULE, $data ); // 获取用户模块权限
		$this->db->select('m.mname,m.uuid');
		$this->db->from ( 'yg_user_module as u' );
		$this->db->join ( 'yg_module as m', 'u.muuid = m.uuid', 'left outer' );
		$this->db->where ( $data );
		//$this->db->order_by ( 'p.ctime DESC' );
		$query = $this->db->get ();	
		//echo$this->db->last_query();
		return $query->result_array () ;
	}
	/**
	 * 获取用户模块权限
	 */
	public function get_module_name($uuid) {
		$data = array (
				'uuid' => $uuid
		);
		$this->db->select('m.mname');
		$this->db->from ( 'yg_module as m' );
		$this->db->where ( $data );
		$query = $this->db->get ();
// 		echo $this->db->last_query();
		return $query->result_array () ;
	}
	
	public function get_modelu_menu($id){
		$data = array (
				'ouuid' => $id
		);
		//$query = $this->db->get_where ( self::TBL_USER_MODULE, $data ); // 获取用户模块权限
		//$this->db->select('m.mname,m.uuid');
		$this->db->from ( 'yg_module_menu as a' );
		$this->db->join ( 'yg_menu as b', 'a.muuid = b.uid', 'left outer' );
		$this->db->where ( $data );
		//$this->db->order_by ( 'p.ctime DESC' );
		$query = $this->db->get ();
// 		echo $this->db->last_query();
		return $query->result_array () ;
	}
	
	public function get_modelu_menus($id){
		$data = array (
				'ouuid' => $id
		);
		//$query = $this->db->get_where ( self::TBL_USER_MODULE, $data ); // 获取用户模块权限
		$this->db->select('b.*');
		$this->db->from ( 'yg_module_menu as a' );
		$this->db->join ( 'yg_menu as b', 'a.muuid = b.uid', 'left outer' );
		$this->db->where ( $data );
		//$this->db->order_by ( 'p.ctime DESC' );
		$query = $this->db->get ();
		// 		echo $this->db->last_query();
		return $query->result_array () ;
	}
	
	public function saveMappingData(){
		$menus = $this->input->post ( 'menuid' );
		$gid = $this->input->post ( 'gid' );
		foreach ($menus as $value) {
			$a = array (
				'uuid' =>$this->unit->guid (),
				'ouuid' => $gid,
				'muuid' =>$value
				);
			$data[] = $a;
		}
		$d = $this->db->delete(self::TBL_MODULE_MENU, array('ouuid' => $gid)); 
		$i = $this->db->insert_batch(self::TBL_MODULE_MENU, $data);
		if($d && $i){
			return array('flag'=>'1');
		}else{
			return array('flag'=>'0','info'=>'error');
		}
	}
}