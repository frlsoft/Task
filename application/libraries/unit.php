<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * �������
 *
 * @author Administrator
 *        
 */
class unit {
	
	/**
	 * php����ȫ��Ψһid��php��������룬php ���������ظ��ַ���
	 */
	function guid() {
		$charid = strtoupper ( md5 ( uniqid ( mt_rand (), true ) ) );
		$uuid = substr ( $charid, 0, 8 ) . substr ( $charid, 8, 4 ) . substr ( $charid, 12, 4 ) . substr ( $charid, 16, 4 ) . substr ( $charid, 20, 12 );
		return $uuid;
	}
	/**
	 * ��ȡpost
	 *
	 * @param unknown $val
	 *        	���յ�����
	 * @param string $filter
	 *        	����Σ���ַ�����������˴��� strictno ����
	 */
	function iconvpost($val, $filter = 'strict') {
		return iconv ( "UTF-8", "GB2312//IGNORE", $val );
	}
	// ��ȡget
	function iconvget($val, $filter = 'strict') {
		return iconv ( "UTF-8", "GB2312//IGNORE", $val );
	}
	// �ϸ�����ַ����е�Σ�շ���
	function strictno($str) {
		return $str;
	}
	// �ϸ�����ַ����е�Σ�շ���
	function strict($str) {
		if (S_MAGIC_QUOTES_GPC) {
			$str = stripslashes ( $str );
		}
		$str = str_replace ( '<', '&#60;', $str );
		$str = str_replace ( '>', '&#62;', $str );
		$str = str_replace ( '?', '&#63;', $str );
		$str = str_replace ( '%', '&#37;', $str );
		$str = str_replace ( chr ( 39 ), '&#39;', $str );
		$str = str_replace ( chr ( 34 ), '&#34;', $str );
		$str = str_replace ( chr ( 13 ) . chr ( 10 ), '', $str );
		return $str;
	}
}
