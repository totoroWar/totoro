<?php 
define('IN_ECS', true); 

require_once dirname(__FILE__).'/../../commons/init.php'; 
$act = $_REQUEST[act];

if (empty($act)) {
	$act = "";	
}

if ($act == "list") { 
	$arr = array();  
	$arr['logfile_logn'] = $_REQUEST['logfile_logn'];
	$stardate = $_REQUEST['stardate'];
	$enddate = $_REQUEST['enddate'];
	
	$where = " where isdelete = 0 and fid = 1";
	foreach ($arr as $ks=>$vs){
		if($vs != ""){
			$where.= "and $ks = '$vs'";
		} 
	}
	
	if($stardate != ''){
		$where.= " and logfile_logdate >= '$stardate 00:00:00'";
	}
	if($enddate != ''){
		$where.= " and logfile_logdate <= '$enddate 23:59:59'";
	}
	$users = $db->get_page("zxclient_log",$where); 
	 
	echo json_encode($users); 
} 
else {
	$smarty->display("admin/account/zxclient.html");
}

?>