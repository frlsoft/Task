<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Org_model extends CI_Model {
	const TBL_ORG = 'YG_ORG';
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	
	/**
	 */
	function addOrg() {
		$pid = $this->input->post ( 'pid' );
		if ($pid == null) {
			$pid = '0';
		}
		$data = array (
				'orgname' => $this->input->post ( 'orgname' ),
				'pid' => $pid,
				'gid' => $this->unit->guid () 
		);
		$query = $this->db->insert ( self::TBL_ORG, $data );
		
		return $ref ['data'] = $query;
	}
	/**
	 */
	function delOrg() {
	}
	/**
	 */
	function updateOrg() {
	}
	/**
	 */
	function getOrgById() {
	}
	/**
	 */
	function listOrg() {
	}
}