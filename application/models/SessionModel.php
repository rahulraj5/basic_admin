<?php defined('BASEPATH') OR exit('No direct script access allowed');
	

class SessionModel extends CI_Model 
{

	public function __construct()
	{
		
	}

	public function checklogin($allow)
    {
       $f_name = $this->router->fetch_method();
       $user = $this->session->userdata('cricwarm_admin');
      
       if(empty($user))
       {
      	  if(in_array($f_name, $allow))		
	      {
	      	return true;
	      }else
	      {
	      	redirect(base_url());
	      }
       }		
	}

	public function checkClientlogin($allow)
	{
	   $f_name = $this->router->fetch_method();
       $user = $this->session->userdata('client_data');
      
       if(empty($user))
       {
      	  if(in_array($f_name, $allow))		
	      {
	      	return true;
	      }else
	      {
	      	redirect("/admin/login");
	      }
       }
	}
}

?>