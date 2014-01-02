<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * 工具类库
 *
 * @author Administrator
 *        
 */
class unit {
	
	/**
	 * php生成全球唯一id，php生成随机码，php 生成永不重复字符串
	 */
	function guid() {
		$charid = strtoupper ( md5 ( uniqid ( mt_rand (), true ) ) );
		$uuid = substr ( $charid, 0, 8 ) . substr ( $charid, 8, 4 ) . substr ( $charid, 12, 4 ) . substr ( $charid, 16, 4 ) . substr ( $charid, 20, 12 );
		return $uuid;
	}
	/**
	 * 获取post
	 *
	 * @param unknown $val
	 *        	接收的数据
	 * @param string $filter
	 *        	过滤危险字符，如果不过滤传递 strictno 方法
	 */
	function iconvpost($val, $filter = 'strict') {
		return iconv ( "UTF-8", "GB2312//IGNORE", $val );
	}
	// 获取get
	function iconvget($val, $filter = 'strict') {
		return iconv ( "UTF-8", "GB2312//IGNORE", $val );
	}
	// 严格过滤字符串中的危险符号
	function strictno($str) {
		return $str;
	}
	// 严格过滤字符串中的危险符号
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
