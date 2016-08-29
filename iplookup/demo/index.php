<?php
/**
* 使用curl 获取ip归属地
* @author Jhin
* @site   http://ijhin.com
* @email  ijhin@sina.com
**/
// 设置 ip
$ip = getIP();
// 接口地址
$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$ip;

$ch = curl_init($url);

// 设置URL和相应的选项
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; 

// 抓取URL并把它传递给浏览器
$data = curl_exec($ch);
// 关闭cURL资源，并且释放系统资源
curl_close($ch);

//格式化一下返回的数据
$data = explode('=', $data);
$data = rtrim($data[1], ";");

//json转换为数组
$data_array = json_decode($data,true);

echo $data_array['city'];


/**
* 获取ip地址
*/
function getIP() {
	if (getenv('HTTP_CLIENT_IP')) {
	$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif (getenv('HTTP_X_FORWARDED_FOR')) {
	$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_X_FORWARDED')) {
	$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif (getenv('HTTP_FORWARDED_FOR')) {
	$ip = getenv('HTTP_FORWARDED_FOR');

	}
	elseif (getenv('HTTP_FORWARDED')) {
	$ip = getenv('HTTP_FORWARDED');
	}
	else {
	$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
} 

//直接使用系统变量
//$reIP=$_SERVER["REMOTE_ADDR"];

//使用三元表达式
/*
$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"]; 
*/
