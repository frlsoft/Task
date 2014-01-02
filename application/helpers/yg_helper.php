<?php
/**
 * ��Ϣ��ʾ��ʽ��1
 * �����е�������,�����Զ���ת.
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
 * ��Ϣ��ʾ��ʽ��2
 * ���Զ���ת
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
 * ʹ���ض�function������������Ԫ��������
 * 
 * @param
 *        	string &$array Ҫ������ַ���
 * @param string $function
 *        	Ҫִ�еĺ���
 * @return boolean $apply_to_keys_also �Ƿ�ҲӦ �õ�key��
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
 * �Զ�����Է���
 * 
 * @param unknown $obj        	
 */
function my_print($obj) {
	echo '<pre>';
	echo '========================�����ָ���=================================';
	print_r ( $obj );
	echo '========================�����ָ���=================================';
}