<?php
require 'common.php';

$typeCom = $_GET["com"];//快递公司
$queryNo = trim($_GET["nu"]);
$captcha = trim($_GET["captcha"]);
header('Content-Type: application/json');

if(empty($queryNo)) {
echo json_encode(array("success" => false, "errorMsg" => '请输入快递单号'));
die();
}

$get_content = array();
if($typeCom == "airMail"){
	if(empty($captcha))
        echo json_encode(array("success" => false, "errorMsg" => '请输入验证码'));
        die();
			$queryNo = strtoupper($queryNo);
			$post = array('sql_ITEMNO'=>$queryNo, 'sql_KCODE'=>$captcha);
			$result = spider('http://intmail.183.com.cn/itemno/web/icc!itemtracecn.action', $post, 'json');
			$msg = $result['sshjqresult']['msg'];
			$result = $result['sshjqresult']['result'];
			if($result) {
				foreach($result as $info) {
					$get_content[] = array('time'=>$info['ITEMEVENTDATE'], 'location'=>$info['ITEMEVENTCNNAME'], 'desc'=>$info['CURRENTSTATUSNAME']);
				}
			}
}

else if($typeCom == "ems"){
	//$url ='http://api.kuaidi100.com/api?id='.$AppKey.'&com='.$typeCom.'&nu='.$queryNo.'&show=2&muti=1&order=asc';
	$url = 'http://www.kuaidi100.com/query?type=ems&postid='.$queryNo;

	//请勿删除变量$powered 的信息，否者本站将不再为你提供快递接口服务。
	$result = spider($url, array(), 'json');
	if($result['state'] == 3 && is_array($result['data'])) {
		foreach($result['data'] as $info) {
			$get_content[] = array('time'=>$info['time'], 'location'=>'', 'desc'=>$info['context']);
		}
	}
	$powered = '该查询数据由：<a href="http://kuaidi100.com" target="_blank" ref="nofollow">KuaiDi100.Com （快递100）</a> 网站提供<br><a href="http://www.kuaidi100.com/all/sf.shtml" rel="nofollow" target="_blank">顺丰快递查询</a>';
}

else if ($typeCom == "ace") {
	$get_content = getAceInfo($queryNo);
	$powered = '查询数据由：<a href="http://www.aircargoexpress.com.au" target="_blank" ref="nofollow">ACE</a> 网站提供 ';
}
else if ($typeCom == "fangzhou") {
	$get_content = getFangzhouInfo($queryNo);
	$powered = '查询数据由：<a href="http://www.arkexpress.com.au/" target="_blank" ref="nofollow">方舟国际速递</a> 网站提供 ';
}

else if ($typeCom == "auexpress") {
	$get_content = getAuexpressInfo($queryNo);
	$powered = '查询数据由：<a href="http://www.auexpress.net/" target="_blank" ref="nofollow">AuExpress</a> 网站提供 ';
}

else if ($typeCom == "lantian") {
	$get_content = getSkyExpressInfo($queryNo);
	$powered = '查询数据由：<a href="http://www.auexpress.net/" target="_blank" ref="nofollow">AuExpress</a> 网站提供 ';
}

// 保存历史
$search_history = json_decode($_COOKIE['search_history'], true);
empty($search_history) && $search_history = array();
if(empty($search_history[$typeCom][$queryNo])) {
	$search_history[$typeCom][$queryNo] = array('label'=>'');
	setcookie('search_history', json_encode($search_history), time()+86400*200);
}

if (count($get_content) > 0) {
    echo json_encode(array("success" => true, "msg" => $get_content));

} else {
    echo json_encode(array("success" => false, "errorMsg" => '对不起，查不到你的订单 <br />请正确填写你的运单号 <br />查询时请核对网上信息与发单上是否一致<br/>如果在此系统中没有查询到我的货物,请与快递公司工作人员联系'));
}


//////////////////// functions /////////////////////////////////
function getAirMailInfo($no) {
	$result = array();
	$post_arr = array('pageNo'=>'0', 'sql_ITEMNO'=>$no, 'sql_KCODE'=> '57dx3');
	$content = spider('http://intmail.183.com.cn/icc-itemtracecn.jsp', $post_arr);
	$content = iconv("gb2312", "utf-8//IGNORE", $content);
	if(empty($content))
		return $result;
	$pattern = "trackList\w{3,4}\'>(?P<time>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<location>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<desc>.*?)<\/td.*?";
	preg_match_all('/'.$pattern.'/', $content, $infos);
	if($infos && is_array($infos['time'])) {
		foreach($infos['time'] as $k=>$time) {
			$result[] = array('time'=>$time, 'location'=>$infos['location'][$k], 'desc'=>$infos['desc'][$k]);
		}
	}
	return $result;
}

function getSkyExpressInfo($no) {
	$result = array();
	$post_arr = array('w'=>'blueskyexpress', 'cno'=>$no, 'ntype'=>0);
	$content = spider('http://track.blueskyexpress.com.au/cgi-bin/GInfo.dll?EmmisTrack', $post_arr);
	$content = iconv("gb2312", "utf-8//IGNORE", $content);
	if(empty($content))
		return $result;
	$pattern = "trackList\w{3,4}\'>(?P<time>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<location>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<desc>.*?)<\/td.*?";
	preg_match_all('/'.$pattern.'/', $content, $infos);
	if($infos && is_array($infos['time'])) {
		foreach($infos['time'] as $k=>$time) {
			$result[] = array('time'=>$time, 'location'=>$infos['location'][$k], 'desc'=>$infos['desc'][$k]);
		}
	}
	return $result;
}

function getAceInfo($no) {
	$result = array();
	$post_arr = array('w'=>'auexp', 'cno'=>$no, 'ntype'=>0);
	$content = spider('http://203.86.8.13/cgi-bin/GInfo.dll?EmmisTrack', $post_arr);
	$content = iconv("gb2312", "utf-8//IGNORE", $content);
	if(empty($content))
		return $result;
	$pattern = "trackList\w{3,4}\'>(?P<time>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<location>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<desc>.*?)<\/td.*?";
	preg_match_all('/'.$pattern.'/', $content, $infos);
	if($infos && is_array($infos['time'])) {
		foreach($infos['time'] as $k=>$time) {
			$result[] = array('time'=>$time, 'location'=>$infos['location'][$k], 'desc'=>$infos['desc'][$k]);
		}
	}
	return $result;
}

function getFangzhouInfo($no) {
	$result = array();
	$post_arr = array('w'=>'arkexpress', 'cno'=>$no, 'ntype'=>0);
	$content = spider('http://www.arkexpress.com.au/cgi-bin/GInfo.dll?EmmisTrack', $post_arr);
	$content = iconv("gb2312", "utf-8//IGNORE", $content);

	if(empty($content))
		return $result;
	$pattern = "trackList\w{3,4}\'>(?P<time>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<location>.*?)<\/td.*?";
	$pattern .= "trackList\w{3,4}\'>(?P<desc>.*?)<\/td.*?";
	preg_match_all('/'.$pattern.'/', $content, $infos);
	if($infos && is_array($infos['time'])) {
		foreach($infos['time'] as $k=>$time) {
			$result[] = array('time'=>$time, 'location'=>$infos['location'][$k], 'desc'=>$infos['desc'][$k]);
		}
	}
	return $result;
}

function getAuexpressInfo($no) {
	$result = array();
	$post_arr = array('OrderId'=>$no);
	$content = spider('http://www.auexpress.net/TOrderQuery.aspx', $post_arr);
	if(empty($content))
		return $result;
	$pattern = "<tr.*?Time\".*?>(?P<time>.*?)\s*?<\/span.*?";
	$pattern .= "Location\".*?>(?P<location>.*?)<\/span.*?";
	$pattern .= "Status\".*?>(?P<desc>.*?)<\/span.*?<\/tr>";
	preg_match_all('/'.$pattern.'/', $content, $infos);
	if($infos && is_array($infos['time'])) {
		foreach($infos['time'] as $k=>$time) {
			$result[] = array('time'=>$time, 'location'=>$infos['location'][$k], 'desc'=>$infos['desc'][$k]);
		}
	}
	return $result;
}

function spider($url, $post_arr=array(), $format='') {
	if (function_exists('curl_init') == 1){
		require_once 'core/Curl.class.php';
		$curl = new Curl();
		$get_content = $curl->execCurl($url, $post_arr);
		if($get_content && $format == 'json')
			$get_content = json_decode($get_content, true);
	}
	return $get_content;
}
?>
