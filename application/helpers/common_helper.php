<?php defined('BASEPATH') OR exit('No direct script access allowed');

function sendEmail($to,$from,$subject,$message)
{
    try {
        
        $headers = "Reply-To: The User <". $from .">\r\n"; 
        //$headers .= "Return-Path: The Sender <sender@sender.com>\r\n"; 
        $headers .= "From: ".getWebOptionValue("company_email")." <". $from .">\r\n"; 
        $headers .= "Organization: ". getWebOptionValue("organization") ."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
        
        if(mail($to,$subject,$message,$headers))
        {
          return true;
        }else
        {
          return false;
        }   
    } catch (Exception $e) {
    	return false;
        //echo $e->getMessage();
    }
}


function sendMailWithAttachment($to,$from,$subject,$pathToUploadedFile,$message)
{
	$ci =&get_instance();
	$ci->email->clear(TRUE);
    //$ci->email->set_header('MIME-Version', 1.0);
    //$ci->email->set_header('Organization', ORGANIZATION);
    //$ci->email->set_header('X-Priority', 3);

    //$ci->email->set_header('X-Mailer', "PHP". phpversion());
    //$this->email->set_header('Content-Type', 'multipart/mixed');
    //$ci->email->set_header('Content-type', 'text/html');
    //$ci->email->set_header('charset', 'iso-8859-1');
    
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';
	  $ci->email->initialize($config);

    $ci->email->reply_to("info@espsofttech.com", COMP_LABEL);
    $ci->email->from("info@espsofttech.com", COMP_LABEL);
    $ci->email->to($to);
    $ci->email->subject($subject);
    if($pathToUploadedFile != "")
    {
    	$ci->email->attach($pathToUploadedFile);
    }
    $ci->email->message($message);
    $result = $ci->email->send();

    return $result; 

	 //    if($result) 
	 //    {
	 //    return true;
		// }
		// else
		// {
		// 	return false;
		// }
}


function send_smtp_mail($to, $from, $subject,$pathToUploadedFile,$message)
{
	$mail = new PHPMailer;
	//$mail->SMTPDebug = true;
	$mail->isSMTP();                                   // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                            // Enable SMTP authentication
	$mail->Username = 'mukesh.espsofttech@gmail.com';          // SMTP username
	$mail->Password = '123qwe,./'; // SMTP password
	$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                 // TCP port to connect to

	$mail->setFrom($from, 'Auction');
	$mail->addReplyTo(ADMIN_EMAIL, 'Auction');
	$mail->addAddress($to);
	$mail->isHTML(true);  // Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $message;

	if(!$mail->send()) {
	    // echo 'Message could not be sent.';
	    // echo 'Mailer Error: ' . $mail->ErrorInfo;
	    return false;
	} else {
	    return true;
	}
}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


/* Send CURL POST Request  */
function makeCallPost($url,$data)
{
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST,true);
	curl_setopt($curl, CURLOPT_POSTFIELDS,$data); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
	
	$result = curl_exec($curl);
	
	if(curl_exec($curl) === false)
	{
	   $err = curl_error($curl);
	   $error = json_decode($err,true);
	   return $error;
	}
	
	curl_close($curl);	
	$arr = json_decode($result,true);
	return $arr;
}

/* Send CURL GET Request  */
function makeCallGet($url,$data = false)
{
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);

	$result = curl_exec($curl);
	
	if(curl_exec($curl) === false)
	{
	   $err = curl_error($curl);
	   $error = json_decode($err,true);
	   return $error;
	}
	
	curl_close($curl);	
	$arr = json_decode($result,true);
	return $arr;
}

function getUserId()
{
	$ci =&get_instance();
	$user_id = $ci->session->userdata("userID");
	return $user_id;
}

function getWebOption($opt_name)
{
	$ci =&get_instance();
	$data = $ci->UserModel->getSingleData("web_options",array("opt_name" => $opt_name));
	return $data;
}

function getWebOptionValue($opt_name)
{
	$ci =&get_instance();
	$optdata = $ci->UserModel->getWhereDataByCol("web_options",array("opt_name" => $opt_name),"opt_value");
  	$opt = (!empty($optdata))? $optdata["opt_value"] : "";
	return $opt;
}

function setHourVal($hu)
{
	$hr = $hu%12;
	$ha = ($hu >= 12)? "PM" : "AM";
	$hr = ($hr == 0)? "12" : $hr;
	return $hr." ".$ha;
}

function checkTabActive($fun)
{ 
  $ci = &get_instance();
  $f_name = $ci->router->fetch_method();
  //p($fun);
  if(in_array($f_name, $fun))   
    {
      return true;
    }else
    {
      return false;
    }
} 

// Chaeck user login if loggin then redirect to dashboard page
function check_user_logged_in()
{
	$ci =&get_instance();
	$user_data = $ci->session->userdata("cricwarm_admin");
	if(!empty($user_data))
	{
		redirect(base_url()."admin/dashboard");
	}else
	{
		return true;
	}
}

function checkSession()
{
  $ci =&get_instance();
  $user = $ci->session->userdata('tour_admin');
  if(!empty($user))
  {
    return true;
  }else{
    return false;
  }
}

function format_price($price)
{
    $pr = number_format($price,2);
    return "$ ".$pr;
}

function setDateFormat($dt)
{
  $jay = date("d-m-Y",strtotime($dt));
  return $jay;
}

function setTimeFormat($tm)
{
  $jay = date("h:i:s A",strtotime($tm));
  return $jay;
}


function __webtxt($word)
{
	return $word;
  /*global $user_lang;

  $ci =&get_instance();
  
  $data = $ci->db->get_where("webtexts",array("lang_id" => $user_lang,"text_eng" => $word))->row_array();
  if(!empty($data["text_lang"]))
  {
    $word = $data["text_lang"];
  }
  return $word;*/
}


function sendResponse($res)
{
	$resp = json_encode($res);
	echo $resp;
	exit();
}

function createRandomCode() 
{ 
    $chars = "023456789ABCDEFGHIJKLMNOPQRST"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 
    while ($i <= 8) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
    return $pass; 
}


function p($data)
{
	echo "<pre>"; print_r($data); die();
}


/*********** Jayendra works start here ******************/

function userLang()
{
	$lang_id = 1;
	return $lang_id;
}

function check_required_value($chk_params, $converted_array) {
	foreach ($chk_params as $param) {
	  if (array_key_exists($param, $converted_array) && ($converted_array[$param] != '')) {

	    $check_error = 0;
	  } else {	
	    $check_error = array('check_error' => 1, 'param' => $param);
	    break;
	  }
	}
	return $check_error;
}

// Extract value from json object according to language id
function extractData($cdata,$lang_id,$val)
{
	$data = array();

	if(!empty($cdata))
	{
		foreach($cdata as $cd)
		{
			if(!empty($val))
			{
				foreach($val as $vl)
				{
					if(array_key_exists($vl, $cd))
					{
						$jay = json_decode($cd[$vl],true);
						$cd[$vl] = $jay[$lang_id];		
					}
				}
				
			}
			array_push($data, $cd);
		}
	}

	return $data;
}

function curDate()
{
	$date = date("Y-m-d H:i:s");
	return $date;
}

/*********** Jayendra works End here ******************/