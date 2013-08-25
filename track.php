<?php
 /**
 * Example Application

 * @package Example-application
 */

require('common.php');

$smarty->assign("title","追踪包裹");
$smarty->assign("logoText","澳洲包裹网");
$smarty->display('trackmyitem.tpl');
?>
