<?php
if(isset($_POST['email'])) {
	if(isset($_POST['shop'])){
		if($_POST['shop'] = "pointcook"){
			$email_to= "pointcook@baoguo.com.au";
		}
	/*
	else if ($_POST['shop'] = "footscray"){
			$email_to = "tandongfang2003@hotmail.com";
			
		}
*/
	}
	
/*
	function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
*/
    
/*
     if(!isset($_POST['shop']) ||
        !isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }
*/
    
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // not required
    $message = $_POST['message']; // required
  /*
  $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
    if(!preg_match($email_exp,$email_from)) {
    $error_message .= '对不起，邮箱填写有误。。<br />';
	  }
	    $string_exp = "/^[A-Za-z .'-]+$/";
	  if(!preg_match($string_exp,$name)) {
	    $error_message .= '请填写您的名字.<br />';
	  }
	  if(strlen($message) < 2) {
	    $error_message .= '亲，写多一点吧。。<br />';
	  }
	  if(strlen($error_message) > 0) {
	    died($error_message);
  }
*/
  	$email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "phone: ".clean_string($phone)."\n";
    $email_message .= "Comments: ".clean_string($message)."\n";
    $email_subject .= "Message from Baoguo.com.au"; 
		     
		// create email headers
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers); 
	echo '<span class="label label-success">谢谢你的邮件，我们会尽快回复你.</span>';
}
