<?php 
define('IN_ECS', true); 
require_once dirname(__FILE__).'/../../commons/init.php'; 

$act = $_REQUEST[act];

if (empty($act)) {
	$act = "";	
}

if ($act == "list") { 
	$arr = array();   
	$arr['client_logn'] = $_REQUEST['client_logn']; 
	$stardate = $_REQUEST['stardate'];
	$enddate = $_REQUEST['enddate'];
	
 	$where = " where isdelete = 0 and bonus_state != 0 "; 
	foreach ($arr as $ks=>$vs){
		if($vs != ""){
			$where.= "and $ks = '$vs'";
		} 
	}
	
	if($stardate != ''){
		$where.= " and bonus_kssj >= '$stardate 00:00:00'";
	}
	if($enddate != ''){
		$where.= " and bonus_kssj <= '$enddate 23:59:59'";
	}
	
	$users = $db->get_page("player_bonus",$where);  
	echo json_encode($users); 
}else {
	$smarty->display("admin/account/wjbonus.html");
}

?>