<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* status */
function status(){
	$data = array(
		'1'=>'ON'
		,'2'=>'OFF'
	);
	return $data;
}
function status_theme(){
	$data = array(
		'1'=>'<span class="label label-success">ON</span>'
		,'2'=>'<span class="label label-danger">OFF</span>'
	);
	return $data;	
}
function get_status($id){
	$data = status_theme();
	return $data[$id];
}
function status_dropdown(){
	$data[''] = '-Status-';
	$status = status();
	foreach($status as $r =>$val){
		$data[$r]=$val;
	}
	return $data;
}

/* level */
function level(){
	$data = array(
		'1'=>'Admin'
		,'2'=>'Auditor'
		,'3'=>'Data Entry'
	);
	return $data;
}
function get_level($id){
	$data = level();
	return $data[$id];
}
function level_dropdown(){
	$data[''] = '-Level-';
	$level = level();
	foreach($level as $r =>$val){
		$data[$r]=$val;
	}
	return $data;
}
