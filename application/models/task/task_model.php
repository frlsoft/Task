<?php
class Task_model extends CI_Model {
	const TBL_TASK = 'yg_task';
	private $data = array ();
	/**
	 * 构造，初始化数据
	 */
	function __construct() {
		parent::__construct ();
		$this->
load->library ( 'unit' );
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
		$query = $this->db->get_where ( self::TBL_TASK, array (
				'uuid' => $gid 
		) );
		// echo $this->db->last_query();
		if ($row = $query->row_array ()) {
			$row ['user_list'] = $query->result_array ();
			return $row;
		}
		return array ();
	}
	public function load_tasks() {
		$query = $this->db->get ( self::TBL_TASK );
		if ($row = $query->result_array ()) {
			return $row;
		}
		return array ();
	}
	/**
	 * 根据当前用户的session gid 值,检索分配表数据再查询主表数据关联
	 * @return unknown multitype:
	 */
	function load_tasks_by_user() {
		$data = array (
				'useruuid' => $this->session->userdata ( 'GID' ) 
		);
		$this->db->select ( 'refer' );
		$refer = $this->db->get_where ( 'yg_assgin_task', $data );
		foreach ( $row = $refer->result_array () as $key ) {
			$t [] = $key ['refer'];
		}
		$this->db->where_in ( 'refer', array_values ( $t ) );
		// $sql = "select * from yg_task a where a.refer in(select b.refer from yg_assgin_task b where b.useruuid = '')";
		// $query = $this->db->get_where ( 'yg_task_assgin', $data );
		$query = $this->db->get_where ( self::TBL_TASK );
		if ($row = $query->result_array ()) {
			return $row;
		}
		return array ();
	}

	/**
	 * 根据当前用户的session gid值获取用户已分配的数据用refer作为数据的键值
	 * @return [array] [返回获取导到数据的数组]
	 */
	function load_assgin_task() {
		$data = array (
				'useruuid' => $this->session->userdata ( 'GID' ) 
		);
		$query = $this->db->get_where ( 'yg_assgin_task', $data );
		if ($query->result_array ()) {
			foreach ( $row = $query->result_array () as $key ) {
				$row [$key ['refer']] = $key;
			}
			return $row;
		}
		return array ();
	}
	/**
	 */
	// id int not null auto_increment,
	// uuid varchar(50) comment '定义自主键',
	// caption varchar(50) comment '简要描述',
	// projectuuid varchar(50) comment '所属项目uuid',
	// planStime datetime comment '计划开始时间',
	// planEtime datetime comment '计划结束时间',
	// grade varchar(50) comment '任务等级',
	// content text comment '任务内容',
	// primary key (id)
	function create() {
		$data = array (
				'caption' => $this->unit->iconvpost ( $this->input->post ( 'caption' ) ),
				'projectuuid' => $this->unit->iconvpost ( $this->input->post ( 'projectuuid' ) ),
				'planStime' => $this->unit->iconvpost ( $this->input->post ( 'planStime' ) ),
				'planEtime' => $this->input->post ( 'planEtime' ),
				'content' => $this->unit->iconvpost ( $this->input->post ( 'content' ) ),
				'refer' => $this->unit->iconvpost ( $this->input->post ( 'refer' ) ),
				'root' => $this->unit->iconvpost ( $this->input->post ( 'root' ) ),
				'proot' => $this->unit->iconvpost ( $this->input->post ( 'root' ) ),
				'edituser' => $this->session->userdata('GID'),
				// 'tjbm' => $this->_tjbm ( $this->input->post ( 'root' ), $this->unit->iconvpost ( $this->input->post ( 'projectuuid' ) ) ),
				// 'createtime' => date ( 'Y-m-d G:i:s' ),
				'uuid' => $this->unit->guid () 
		);
		$query = $this->db->insert ( self::TBL_TASK, $data );
		// echo $this->db->last_query();
		if ($query) {
			return array (
					'flag' => '1' 
			);
		} else {
			return array (
					'flag' => '0' 
			);
		}
	}
	function _tjbm($proot, $projectuuid) {
		$query = $this->db->get_where ( 'yg_project', array (
				'uuid' => $projectuuid 
		) );
		$row = $query->row_array ();
		$tjbmpre = $row ['tjbmpre'];
		
		if ($proot == '00') { // 为根节点、生成一个新的统计编码
			$query = $this->db->get_where ( self::TBL_TASK, array (
					'proot' => $proot 
			) );
			if ($query->num_rows () > 0) { // 非根节点有效
				$row = $query->row_array ();
				$tjbm = $row ['tjbm'];
				$tjbm = array (
						$tjbm + 1 
				);
			} else {
				$tjbm = array (
						'AA' 
				);
			}
		} else {
			$query = $this->db->get_where ( self::TBL_TASK, array (
					'root' => $proot 
			) );
			
			$query1 = $this->db->get_where ( self::TBL_TASK, array (
					'proot' => $proot 
			) );
			if ($query->num_rows () > 0) { // 非根节点有效
				$row = $query->row_array ();
				$temp = $row ['tjbm'];
				$tjbm = explode ( "-", $temp );
				$max = count ( $tjbm );
				$c = 10;
				if ($max == 1) {
					echo '102';
					$tjbm [1] = $c;
					my_print ( $tjbm );
				} else {
					echo '106';
					my_print ( $tjbm [$max - 1] );
					if ($tjbm [$max - 1]) {
						$c = ( int ) $tjbm [$max - 1] + 1;
					}
					$tjbm [$max - 1] = $c;
				}
				// if (is_array ( $s )) {
				
				// } else {
				// $tjbm [0] = $temp;
				// $tjbm [1] = $c;
				// }
			}
		}
		return implode ( "-", $tjbm );
	}
	/**
	 */
	function update() {
		if (true) {
			$data = array (
					'caption' => $this->unit->iconvpost ( $this->input->post ( 'caption' ) ),
					'projectuuid' => $this->unit->iconvpost ( $this->input->post ( 'projectuuid' ) ),
					'planStime' => $this->unit->iconvpost ( $this->input->post ( 'planStime' ) ),
					'planEtime' => $this->input->post ( 'planEtime' ),
					'content' => $this->unit->iconvpost ( $this->input->post ( 'content' ) ),
					'refer' => $this->unit->iconvpost ( $this->input->post ( 'refer' ) ) 
			// 'refer' => $this->unit->iconvpost ( $this->input->post ( 'refer' ) ),
			// 'createtime' => date ( 'Y-m-d G:i:s' ),
			// 'uuid' => $this->unit->guid ()
						);
			$this->db->where ( 'uuid', $this->input->post ( 'gid' ) );
			$query = $this->db->update ( self::TBL_TASK, $data );
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
					'flag' => '0',
					'info' => 'task_module update() ' 
			);
		}
	}
	/**
	 *
	 * @param unknown $gid        	
	 */
	function delete($gid) {
		$this->db->where ( 'gid', $gid );
		return $this->db->delete ( self::TBL_TASK );
	}
	/**
	 *
	 * @return unknown multitype:
	 */
	function find_users() {
		$query = $this->db->get ( self::TBL_TASK );
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
			$query = $this->db->insert ( self::TBL_TASK, $data );
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
	function user_exits() {
		$data = array (
				'name' => $this->input->post ( 'name' ),
				'yhbh' => $this->input->post ( 'yhbh' ) 
		);
		$query = $this->db->get_where ( self::TBL_TASK, $data );
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
		return $this->db->get ( self::TBL_TASK );
	}
	/**
	 */
	function taskUser($refer) {
		$data = array (
				'refer' => $refer 
		);
		$query = $this->db->get_where ( 'yg_assgin_task', $data );
		$row = array ();
		foreach ( $query->result_array () as $key ) {
			$row [$key ['useruuid']] = $key;
		}
		return $row;
	}
	function assginTask($data) {
		if ($data ['flag']) {
			if (! $data ['refer']) { // no
				$refer = $this->unit->guid ();
				$data ['refer'] = $refer;
			}
			$data ['uuid'] = $this->unit->guid ();
			$data ['ctime'] = date ( 'Y-m-d G:i:s' );
			$query = $this->db->insert ( 'yg_assgin_task', $data );
		} else {
			$data ['flag'] = '1';
			// 判断是否对方是否已经读取
			$query = $this->db->get_where ( 'yg_assgin_task', $data );
			$row = $query->row_array ();
			if ($row ['readed']) {
				return array (
						'flag' => '0',
						'info' => 'user readed',
						'refer' => $data ['refer'] 
				);
			} else {
				$query = $this->db->delete ( 'yg_assgin_task', $data );
			}
		}
		
		if ($query) {
			return array (
					'flag' => '1',
					'info' => 'success',
					'refer' => $data ['refer'] 
			);
		} else {
			return array (
					'flag' => '0',
					'info' => 'error',
					'refer' => $data ['refer'] 
			);
		}
	}
	function set_readed() {
		$data = array (
				'useruuid' => $this->session->userdata ( 'GID' ),
				'refer' => '' 
		);
		$this->db->where ( $data );
		$query = $this->db->update ( self::TBL_TASK, array (
				'readed' => '1' 
		) );
		
		// echo $this->db->last_query ();
	}
	
	/**
	 * 用户读取任务信息时将是否读取状态设为已读
	 *
	 * @param string $uuid        	
	 * @return multitype:array('flag'=>'1','info'=>'info')
	 */
	function setTaskReaded($uuid) {
		$data = array (
				'uuid' => $uuid 
		);
		$task = $this->db->query ( "select a.* from yg_task a where a.refer = (select b.refer from yg_assgin_task b where b.uuid='" . $uuid . "')" );
		$obj = $task->row_array ();
		$this->db->where ( $data );
		$query = $this->db->update ( 'yg_assgin_task', array (
				'readed' => '1',
				'taskuuid' => $obj ['uuid'] 
		) );
		return $obj;
	}
	/**
	 * 将下发任务数据创建在个人空间内
	 *
	 * @param unknown $uuid        	
	 */
	function getTaskToWork($uuid) {
		$this->db->select ( 'refer,useruuid' );
		$query = $this->db->get_where ( 'yg_assgin_task', array (
				'uuid' => $uuid 
		) );
		$row = $query->row_array ();

		$useruuid = $row ['useruuid'];
		
		$query = $this->db->get_where ( 'yg_task', array (
				'refer' => $row ['refer'] 
		) );
		$row = $query->row_array ();
		$taskuuid = $row ['uuid'];
		
		$data = array (
				'uuid' => $this->unit->guid (),
				'useruuid' => $useruuid,
				'taskuuid' => $taskuuid,
				// 'extdate' => date ( 'Y-m-d' ),设置用户自动任务抽取日期请当天日期减少一日保证下次能成功抽取
				'ctime' => date ( 'Y-m-d G:i:s' ) 
		);
		// 防止重复插入
		$query = $this->db->get_where ( 'yg_do_task', array (
				'useruuid' => $useruuid,
				'taskuuid' => $taskuuid 
		) );
		//my_print ($data);
		//return ;
		if (! ($query->num_rows () > 0)) {
			//$query = 
			$this->db->insert ( 'yg_do_task', $data );
		}

		// 装备数据
		$editing = array ();
	}
	/**
	 * 设置任务开始工作时间
	 *
	 * @param unknown $uuid        	
	 * @return multitype:
	 */
	function setTaskStartTime($uuid) {
		$sql = "select a.useruuid,a.taskuuid from yg_assgin_task a where uuid='" . $uuid . "'";
		$assgin = $this->db->query ( $sql );
		$row = $assgin->row_array ();
		if ($row) {
			$data = array (
					'useruuid' => $row ['useruuid'],
					'taskuuid' => $row ['taskuuid'] 
			);
			$this->db->where ( $data );
			$this->db->where('starttime is null', null);
			$query = $this->db->update ( 'yg_do_task', array (
					'starttime' => date ( 'Y-m-d G:i:s' ),
					'extdate' => date ( 'Y-m-d' ,strtotime('-1 day'))//,设置用户自动任务抽取日期请当天日期减少一日保证下次能成功抽取
			) );
		}else{
			//无关联任务设置启动无效
		}
		//echo $this->db->last_query ();
		return array ('flag'=>'1','info'=>'task start at :'.date ( 'Y-m-d G:i:s' ));
	}
	
	/**
	 * 设置任务结束工作时间
	 *
	 * @param unknown $uuid
	 * @return multitype:
	 */
	function setTaskFinishTime($uuid) {
		$uuid = $this->unit->iconvpost ( $this->input->post ( 'uuid' ) );
		$sql = "select a.useruuid,a.taskuuid from yg_assgin_task a where uuid='" . $uuid . "'";
		$assgin = $this->db->query ( $sql );
		$row = $assgin->row_array ();
		if ($row) {
			$data = array (
					'useruuid' => $row ['useruuid'],
					'taskuuid' => $row ['taskuuid']
			);
			$this->db->where ( $data );
			$this->db->where('finishtime is null', null);
			$query = $this->db->update ( 'yg_do_task', array (
					'finishtime' => date ( 'Y-m-d G:i:s' ),
					'extdate' => date ( 'Y-m-d')
			) );
		}else{
			//无关联任务设置启动无效
		}
		//echo $this->db->last_query ();
		return array ('flag'=>'1','info'=>'task finis at :'.date ( 'Y-m-d G:i:s' ));
	}
	/**
	 * 手工抽取个人任务
	 */
	function exttask() {
		$user = $this->session->userdata ( "GID" );
		$sql = "select * from yg_do_task where useruuid='" . $user . "' and starttime is not null and finishtime is null and extdate
< DATE_FORMAT(NOW(),'%Y-%m-%d')";
		$query = $this->
	db->query ( $sql );
		$result = $query->result_array ();
		// my_print ( $result );
		if ($result) {
			$flag = $this->dayTask ( $result );
			if ($flag) {
				// echo '标记已经抽取成功的数据';
				$update = "update yg_do_task set extdate=DATE_FORMAT(NOW(),'%Y-%m-%d') ,lastexttime=DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s') where useruuid='" . $user . "' and starttime is not null and finishtime is null and extdate
	< DATE_FORMAT(NOW(),'%Y-%m-%d')";
				$r = $this->
		db->query ( $update );
				if ($r) {
					return array (
							'flag' => '1',
							'info' => '当日无任务或已经自动生成任务，请检查个人任务表' 
					);
				} else {
					return array (
							'flag' => '0',
							'info' => '回写任务状态失败' 
					);
				}
			} else {
				// echo '任务抽取失败哦！';
				return array (
						'flag' => '0',
						'info' => '任务抽取失败哦！' 
				);
			}
		} else {
			// echo '当日无任务或已经自动生成任务，请检查个人任务表';
			return array (
					'flag' => '1',
					'info' => '当日无任务或已经自动生成任务，请检查个人任务表' 
			);
		}
	}
	/**
	 * 将抽取到的任务数据加载到个人任务表中，并返回加载是否成功的标志
	 *
	 * @param unknown $tasks        	
	 * @return boolean
	 */
	function dayTask($tasks = array()) {
		$tabl = 'yg_day_task';
		
		/**
		 * id int not null auto_increment,
		 * uuid varchar(50),
		 * useruuid varchar(50),
		 * taskuuid varchar(50),
		 * ctime datetime,
		 * starttime datetime comment '任务启动时间',
		 * finishtime datetime comment '完成时间',
		 * douuid varchar(50) comment '管理yg_do_task uuid',
		 */
		foreach ( $tasks as $v ) {
			$task = $this->_getTaskBody ( $v ['taskuuid'] );
			$temp = array (
					'uuid' => $this->unit->guid (),
					'useruuid' => $v ['useruuid'],
					'taskuuid' => $v ['taskuuid'],
					'ctime' => date ( 'Y-m-d G:i:s' ),
					'starttime' => date ( 'Y-m-d G:i:s' ),
					'douuid' => $v ['uuid'] 
			);
			$data [$v ['taskuuid']] = array_merge ( $temp, $task );
		}
		// 生成一条基于你所提供的数据的SQL插入字符串并执行查询
		$query = $this->db->insert_batch ( 'yg_day_task', $data );
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function _getTaskBody($uuid) {
		$this->db->select ( 'caption,projectuuid,planStime,planEtime,grade,content' );
		$query = $this->db->get_where ( 'yg_task', array (
				'uuid' => $uuid 
		) );
		return $query->row_array ();
	}

	/**
	 * 审核任务进行评分，如何任务完成不符合要求，可以重新开始任务
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function auditTask($value=''){
		$uuid = $this->unit->iconvpost ( $this->input->post ( 'uuid' ) );
		$remark = $this->unit->iconvpost ( $this->input->post ( 'remark' ) );
		$score = $this->unit->iconvpost($this->input->post ( 'score' ));
		$this->db->where('uuid', $uuid);
		$data = array('remark' => $remark,'score'=>$score );
		$query = $this->db->update('yg_work', $data);
	}

	/**
	 * 获取当前用户的待审批任务数据
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function auditWatiTask($value='')
	{
		$sql = "select * from yg_task where uuid in (select taskuuid from yg_do_task where starttime is not null and finishtime is not null) and edituser='".$this->session->userdata('GID')."'";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0) {
			return $query->result_array();
		}else{
			return  array( );
		}
	}
}