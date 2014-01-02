<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Org extends CI_Controller {
	// ���캯��
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'org_model' );
	}
	/**
	 * ��ʾ��֯����
	 */
	function listOrg($orgParId = "") {
		$data ['result'] = $this->org_model->list_org ();
		$this->load->view ( 'org/list', $data );
	}
	
	/**
	 * �����֯����
	 */
	function addOrg() {
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		// 
		$this->form_validation->set_rules ( 'orgname', '��ɫ����', 'required' );
		
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