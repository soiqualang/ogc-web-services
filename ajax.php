<?php
include('simple_html_dom.php');
if(isset($_REQUEST['btn'])){
	$btn=$_REQUEST['btn'];
	if($btn=='get_layers'){
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$def=explode ('&request=',$actual_link);
		$urlservice=$_REQUEST['urlservice'];
		$url=$urlservice.'?request='.$def[1];
		$html = file_get_html($url);
		$xml = simplexml_load_string($html);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		echo $json;
	}
	if($btn=='downloadmap'){
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$def=explode ('&request=',$actual_link);
		$urlservice=$_REQUEST['urlservice'];
		$url=$urlservice.'?request='.$def[1];
		$html = file_get_html($url);
		/* $xml = simplexml_load_string($html);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE); */
		echo $html;
	}
}
?>