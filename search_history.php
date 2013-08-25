<?php
/**
 * 搜索历史
 */

require('common.php');

$typeCom = trim($_POST["com"]); // 快递公司
$queryNo = trim($_POST["nu"]);
$action = trim($_POST["action"]);
$history = json_decode($_COOKIE['search_history'], true);
if(empty($typeCom) || empty($queryNo))
	die('0');

if($action == 'del') {	// 删除
	unset($history[$typeCom][$queryNo]);
	setcookie('search_history', json_encode($history), time()+86400*200);
} else if($action == 'edit') {	// 修改备注
	$label = trim($_POST["label"]);
	if($label) {
		$history[$typeCom][$queryNo]['label'] = $label;
		setcookie('search_history', json_encode($history), time()+86400*200);
	}
}
echo '1';
?>
