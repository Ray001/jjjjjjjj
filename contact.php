<?php

session_start();
require('libs/Smarty.class.php');
require('libs/SmartyValidate.class.php');

$smarty = new Smarty;


 

$smarty->assign("title","联系我们");
$smarty->assign("logoText","澳洲包裹网");


/*
$smarty->assign('footscray',
    array('name' => 'Footscray Milkbar',
    	  'address' => '2 Empire Street Footscray VIC 3011 (麦当劳店后面街口)',
          'email' => 'tandongfang2003@hotmail.com',
          'phone' => array('home' => '0393175883',
                           'mobile' => '0423378680')
               )
         );
*/

$smarty->assign('laverton',
    array('name' => 'Laverton / Point Cook',
    	  'address' => '1A armstrong street,Laverton 3028(Laverton 火车站附近)',
          'email' => 'pointcook@baoguo.com.au',
          'phone' => array('Alicia' => '0413589526',
                           'Hao' => '0423632793')
                           )
         );
         
	

$smarty->display('contact.tpl');
