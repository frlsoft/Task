<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 项目处理控制器
 *
 * @author Administrator
 *        
 */
class Project extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		if (! $this->session->userdata ( 'logged_in' )) {
			$arr ['message'] = array (
					'flag' => '0',
					'info' => 'time out' 
			);
			echo json_encode ( $arr );
			exit ();
		}
		error_reporting ( 1 );
		$this->load->helper ( 'form' );
		// 加载表单验证类
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'project_model' );
		// echo "<pre>";
	}
	
	/**
	 * 初始化表单页面
	 */
	function index() {
		$data = array ();
		$options = '';
		// 分页设置
		$per_page = 15;
		$data ['total_rows'] = $this->project_model->count_projects ( $options );
		// 总页数
		$data ['total_pages'] = ceil ( $data ['total_rows'] / $per_page );
		// 当前页（input）
		$data ['page'] = $page_offset + 1;
		$data ['page'] = ($data ['page'] > $data ['total_pages'] && $data ['total_pages'] > 0) ? $data ['total_pages'] : $data ['page'];
		$data ['projects'] = $this->project_model->find_projects ();
		$data ['orgs'] = $this->org_model->find_org_sets ();
		//my_print ( $data );
		$this->load->view ( 'project/list', $data );
	}
	
	/**
	 * 创建数据
	 */
	function add() {
		$this->edit ();
	}
	
	/**
	 * 编辑数据
	 */
	function edit() {
		$data ['title'] = '创建新项目';
		$data ['projects'] = array ();
		$params = $this->uri->uri_to_assoc ();
		// echo $params ['gid'];
		if (! empty ( $params ['gid'] )) {
			$gid = $params ['gid'];
			$data ['editing'] = $this->project_model->load ( $gid );
			if (! $data ['editing']) {
				return array (
						'gid:' . $gid,
						'user' 
				);
			}
			// 预处理用户数据
			$projects_list = array ();
			foreach ( $data ['editing'] ['projects_list'] as $key => $attr ) {
				$projects_list [$attr ['ID']] ['id'] = $attr ['id'];
				$projects_list [$attr ['ID']] ['uuid'] = $attr ['uuid'];
				$projects_list [$attr ['ID']] ['pname'] = $attr ['pname'];
				$projects_list [$attr ['ID']] ['ctime'] = $attr ['ctime'];
				$projects_list [$attr ['ID']] ['ppath'] = $attr ['ppath'];
				$projects_list [$attr ['ID']] ['pouuid'] = $attr ['pouuid'];
				$projects_list [$attr ['ID']] ['planstime'] = $attr ['planstime'];
				$projects_list [$attr ['ID']] ['planetime'] = $attr ['planetime'];
				$projects_list [$attr ['ID']] ['cuseruuid'] = $attr ['cuseruuid'];
				$projects_list [$attr ['ID']] ['orgid'] = $attr ['orgid'];
			}
		/**
		 * id int not null auto_increment comment '主键',
		 * uuid varchar(50) comment '自定义主键',
		 * pname varchar(100) comment '项目名称',
		 * ctime datetime comment '创建时间',
		 * ppath varchar(50) comment '项目文档管理路径',
		 * pouuid varchar(50) comment '项目经理uuid',
		 * planstime datetime comment '项目计划开始时间',
		 * planetime datetime comment '项目计划结束时间',
		 * cuseruuid varchar(50) comment '项目创建者UUID',
		 * orgid varchar(50) comment '所属组织机构代码'
		 */
		} else { // 准备空数据 及默认数据
			$data = array ();
		}
		$data ['orgs'] = $this->org_model->find_org_sets ();
		$this->load->view ( 'project/edit', $data );
	}
	
	/**
	 * 保存数据
	 */
	function save() {
		// 用户gid
		$gid = $this->input->post ( 'gid' );
		// 验证规则
		$this->_set_save_form_rules ();
		if (TRUE === $this->form_validation->run ()) {
			if ($gid) { // 编辑
				$arr ['message'] = $this->project_model->update ();
			} else { // 新增
				$arr ['message'] = $this->project_model->create ();
			}
		} else {
			$arr ['message'] = array (
					'flag' => '0',
					'info' => validation_errors () 
			);
		}
		echo JSON ( $arr );
	}
	
	/**
	 * 设置验证规则
	 */
	function _set_save_form_rules() {
		$rules = array (
				array (
						'field' => 'pname',
						'label' => 'pname',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'planstime',
						'label' => 'planstime',
						'rules' => 'trim|required' 
				),
				array (
						'field' => 'planetime',
						'label' => 'planetime',
						'rules' => 'trim|required' 
				) 
		);
		$this->form_validation->set_message ( 'required', 'field required erroe' );
		// $this->form_validation->set_message('trim', '不能为空');
		$this->form_validation->set_error_delimiters ( "<div class='error'>", "</div>" ); // 去掉界定符号
		$this->form_validation->set_rules ( $rules );
	}
}

/* End of file Project.php */
/* Location: ./application/controllers/Project.php */