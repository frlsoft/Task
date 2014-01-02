<?php
class Weather_model extends CI_Model {
	const TBL_YG_WEATHER = 'YG_WEATHER';
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'unit' );
	}
	function set_weather($data) {
		print_r ( $data );
		$weather = Array (
				"city" => mb_convert_encoding ( $data ['city'], "GB2312", "utf-8" ),
				"cityid" => $data ['cityid'],
				"temp" => $data ['temp'],
				"WD" => mb_convert_encoding ( $data ['WD'], "GB2312", "utf-8" ),
				"WS" => mb_convert_encoding ( $data ['WS'], "GB2312", "utf-8" ),
				"SD" => $data ['SD'],
				"WSE" => $data ['WSE'],
				"time" => $data ['time'], // $data ['time'],
				"isRadar" => $data ['isRadar'],
				"Radar" => $data ['Radar'],
				"CTIME" => date ( 'Y-m-d G:i:s' ) 
		);
		
		// $weather = array('')
		$ref = $this->db->insert ( self::TBL_YG_WEATHER, $weather );
	}
	
	// Xml 转 数组, 包括根键
	public function xml_to_array($xml) {
		$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
		if (preg_match_all ( $reg, $xml, $matches )) {
			$count = count ( $matches [0] );
			for($i = 0; $i < $count; $i ++) {
				$subxml = $matches [2] [$i];
				$key = $matches [1] [$i];
				if (preg_match ( $reg, $subxml )) {
					$arr [$key] = xml_to_array ( $subxml );
				} else {
					$arr [$key] = $subxml;
				}
			}
		}
		return $arr;
	}
	// Xml 转 数组, 不包括根键
	public function xmltoarray($xml) {
		$arr = xml_to_array ( $xml );
		$key = array_keys ( $arr );
		return $arr [$key [0]];
	}
}