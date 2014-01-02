<?php
/**
 * 信息提示方式：1
 * 带多行导航链接,不带自动跳转.
 *
 * @param string $message
 * @param array $gotos
 */
function show_message1($message) {
	header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
	header ( "Cache-Control: no-cache, must-revalidate" );
	header ( "Pragma: no-cache" );
	$args = func_get_args ();
	array_shift ( $args );
	$CI = get_instance ();
	$data ['gotos'] = $args;
	$data ['message'] = ( string ) $message;
	$CI->load->view ( '_show_message1', $data );
}

/**
 * 信息提示方式：2
 * 带自动跳转
 *
 * @param string $message        	
 * @param string $goto        	
 */
function show_message2($message, $goto) {
	header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
	header ( "Cache-Control: no-cache, must-revalidate" );
	header ( "Pragma: no-cache" );
	$CI = get_instance ();
	$data ['goto'] = ( string ) $goto;
	$data ['message'] = ( string ) $message;
	$CI->load->view ( '_show_message2', $data );
}
function JSON($array) {
	arrayRecursive ( $array, 'urlencode', true );
	$json = json_encode ( $array );
	return urldecode ( $json );
}
/**
 * ************************************************************
 *
 * 使用特定function对数组中所有元素做处理
 * 
 * @param
 *        	string &$array 要处理的字符串
 * @param string $function
 *        	要执行的函数
 * @return boolean $apply_to_keys_also 是否也应 用到key上
 * @access public
 *         @url http://blog.csdn.net/to_utopia/article/details/5827614
 *         ***********************************************************
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false) {
	static $recursive_counter = 0;
	if (++ $recursive_counter > 1000) {
		die ( 'possible deep recursion attack' );
	}
	foreach ( $array as $key => $value ) {
		if (is_array ( $value )) {
			arrayRecursive ( $array [$key], $function, $apply_to_keys_also );
		} else {
			$array [$key] = $function ( $value );
		}
		
		if ($apply_to_keys_also && is_string ( $key )) {
			$new_key = $function ( $key );
			if ($new_key != $key) {
				$array [$new_key] = $array [$key];
				unset ( $array [$key] );
			}
		}
	}
	$recursive_counter --;
}
/**
 * 自定义调试方法
 * 
 * @param unknown $obj        	
 */
function my_print($obj) {
	echo '<pre>';
	echo '========================华丽分割线=================================';
	print_r ( $obj );
	echo '========================华丽分割线=================================';
}