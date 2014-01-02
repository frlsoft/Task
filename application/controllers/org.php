<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Org extends CI_Controller {
	// 构造函数
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'org_model' );
	}
	/**
	 * 显示组织机构
	 */
	function listOrg($orgParId = "") {
		$data ['result'] = $this->org_model->list_org ();
		$this->load->view ( 'org/list', $data );
	}
	
	/**
	 * 添加组织机构
	 */
	function addOrg() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// 
		$this->form_validation->set_rules ( 'orgname', '角色名称', 'required' );
		
		if ($this->form_validation->run () === FALSE) { // 
			$this->load->view ( 'org/add' );
		} else { // form 
			$data = $this->org_model->addOrg ();
			if ($data) {
				$this->load->view ( 'success', $data );
			} else {
				$this->load->view ( 'fail', $data );
			}
		}
	}
}