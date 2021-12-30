<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
 
class Users extends REST_Controller {

	// ACCESS-TOKEN : e10adc3949ba59abbe56e057f20f883e
	//public $cur_date; 

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('common_helper');

		// $this->cur_date = date('Y-m-d H:i:s');

	}

	public function CustomerRegistration_post()
	{
		// echo "Demo";
		$data = $_POST;
    	// $user_id = $data['user_id'];
    	$object_info = $data;
    	$required_parameter = array('access_token','name','email','language_id','password','mobile_no','device_type','fcm_token','address','latitude','longitude');

		$chk_error = check_required_value($required_parameter, $object_info);
		if ($chk_error)
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
		 
		   	$this->response($resp);
		}

		$email = $data['email'];
		$mobile_no = $data['mobile_no'];


		$check_email = $this->common_model->GetWhere('users',array('email'=>$email));
		$check_mobile = $this->common_model->GetWhere('users',array('mobile_no'=>$mobile_no));
		if(!empty($check_email) && !empty($check_mobile))
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Email & Mobile no already exits"));
			$this->response($resp);
		}

		if(!empty($check_email))
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Email already exits"));
			$this->response($resp);

		}

		if(!empty($check_mobile))
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Mobile no already exits"));
			$this->response($resp);
		}

		$insert_data = array();
		$insert_data['name'] = $data['name'];
		$insert_data['email'] = $data['email'];
		$insert_data['password'] = md5($data['password']);
		$insert_data['mobile_no'] = $data['mobile_no'];
		$insert_data['address'] = $data['address'];
		$insert_data['latitude'] = $data['latitude'];
		$insert_data['longitude'] = $data['longitude'];
		$insert_data['device_type'] = $data['device_type'];
		$insert_data['fcm_token'] = $data['fcm_token'];
		$insert_data['userrole'] = 11;
		$insert_data['create_date'] = date('Y-m-d H:i:s');
		$insert_data['reg_id'] = $this->createCode('users','reg_id');


		$result_id = $this->common_model->addrecord('users',$insert_data);

    	if(!empty($result_id))
    	{
    		$user_data = $this->common_model->GetWhere('users',array('id'=>$result_id));
    		$resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('success_lable'=>"Registration has been done successfully.",'user_data' => $user_data[0],'img_url'=>IMG_URL));

    	}
    	else
    	{
    		$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Data not found"));
    	}

    	$this->response($resp);
    }

    public function CustomerLogin_Post()
    {
    	$data = $_POST;
    	// $user_id = $data['user_id'];
    	$object_info = $data;
    	$required_parameter = array('access_token','email','password','device_type','fcm_token','address','latitude','longitude');

		$chk_error = check_required_value($required_parameter, $object_info);
		if ($chk_error)
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
		 
		   	$this->response($resp);
		}

		$accesstoken = $data['access_token'];

		if($accesstoken != ACCESSTOKEN)
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Invalid access token please try again"));
			$this->response($resp);
		}

		$email = $data['email'];
		$password = md5($data['password']);


		$check_user = $this->common_model->GetWhere('users',array('email'=>$email,'password'=>$password));
		// print_r($check_user);

		if(empty($check_user))
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Invalid Email or Password"));
			$this->response($resp);
		}

		if(!empty($check_user))
		{
			$check_user = $check_user[0];

			if($check_user['status'] == 0)
			{
				$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Your account has been Deactivated"));
				$this->response($resp);
			}
			if($check_user['status'] == 3)
			{
				$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Your account has been Deleted"));
				$this->response($resp);
			}

			if($check_user['userrole'] != 11)
			{
				$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Invalid user details please try again"));
				$this->response($resp);
			}

			if($check_user['status'] == 1)
			{
				$user_id = $check_user['id'];
				$update_data = array();
				$update_data['device_type'] = $data['device_type'];
				$update_data['fcm_token'] = $data['fcm_token'];
				$update_data['address'] = $data['address'];
				$update_data['latitude'] = $data['latitude'];
				$update_data['longitude'] = $data['longitude'];

				$this->common_model->updateData('users',$update_data,array('id'=>$user_id));

				$user_data = $this->common_model->GetWhere('users',array('id'=>$user_id));
    			$resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $user_data[0],'img_url'=>IMG_URL));
    			$this->response($resp);
			}

		}
	}

	public function Language_post()
    {
    	// $data = $_POST;
    	// // $user_id = $data['user_id'];
    	// $object_info = $data;
    	$pdata = file_get_contents("php://input");
	    $data = json_decode( $pdata,true );
	    $object_info = $data;
		$required_parameter = array('access_token');

		$chk_error = check_required_value($required_parameter, $object_info);

		if ($chk_error)
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
		 
		   	$this->response($resp);
		}

		$accesstoken = $data['access_token'];

		if($accesstoken != ACCESSTOKEN)
		{
			$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Invalid access token please try again"));
			$this->response($resp);
		}

    	
    	$whr = array('status'=>1);
		$language_data = $this->common_model->GetWhere('language',$whr);

    	if(!empty($language_data))
    	{
    		$resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('language_data' => $language_data,'img_url'=>IMG_URL));

    	}
    	else
    	{
    		$resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error_lable' => "Data not found"));
    	}

    	$this->response($resp);
    }

    public function createCode($table,$column_name)
	{

        $jc = ""; 

        $jay = createRandomCode();

        $js = $this->common_model->getSingleRecordById($table,array($column_name => $jay));

        if(!empty($js))

        {

          $jc = $this->createCode($table,$column_name);

        }else

        {

          $jc = $jay;

        }

        return $jc;
    }
}