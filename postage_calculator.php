<?php

session_start();
require_once 'core/connect.php';
require('libs/Smarty.class.php');
require('libs/SmartyValidate.class.php');

$smarty = new Smarty;


$smarty->assign("title","计算运费");
$smarty->assign("logoText","澳洲包裹网");
         

         
$sql = 'select priceID,weightRange,ausPostAirPrice,ausPostExpPrice,ourAirPrice,ourExpPrice from price order by priceID';

$result = mysql_query($sql) or die("Query failed : " . mysql_error());

while ($line = mysql_fetch_assoc($result))
{
 $value[] = $line;
}


$pagesize = 2;
$totalpage = ceil($line/$pagesize);
$page = ceil($_GET["pos"])+1;



$smarty->assign('totalpage',$totalpage);
$smarty->assign('price', $value);
$smarty->display('calculator.tpl');
