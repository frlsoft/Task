<?php
class Weather extends CI_Controller {
	function __construct() {
		parent::__construct ();
		error_reporting ( 1 );
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'weather_model' );
	}
	function index() {
		$url = 'http://m.weather.com.cn/data/101070101.html';
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$ret = curl_exec ( $ch );
		// echo $ret."<br>";
		// //$info = mb_convert_encoding ( $ret, "GB2312", "utf-8" );
		// $info =substr($info,0,strlen($info));
		// echo $info;
		// var_dump($info);
		
		$ret = json_decode ( $ret );
		// // $ret = json_decode ( mb_convert_encoding($ret,'utf8','gbk' ));
		// $ret = mb_convert_encoding ( $ret, "GB2312", "utf-8" );
		
		var_dump ( $ret );
		// $ret = std_class_object_to_array($ret);
		print_r ( $ret->weatherinfo->city );
		// print_r ( mb_convert_encoding ( $ret->weatherinfo->city, "GB2312", "utf-8" ) );
	}
	// http://www.weather.com.cn/data/sk/101220607.html
	// $url = 'http://flash.weather.com.cn/sk2/101070101.xml';
	
	
	function getWeather() {
		$url = 'http://www.weather.com.cn/data/sk/101070101.html';		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$ret = curl_exec ( $ch );
		// echo $ret;
		// var_dump($ret);
		// $ret = mb_convert_encoding ( $ret, "GB2312", "utf-8" );
		
		$ret = json_decode ( $ret, TRUE );
		// // echo $ret;
		$data = $ret ['weatherinfo'];
		
		$data = $this->weather_model->set_weather ( $data );
		// $ret = mb_convert_encoding ( $ret, "GB2312", "utf-8" );
	}
}