<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();

		$this->SessionModel->checklogin(array("index"));
	}


	public function index()
	{
		check_user_logged_in();

		$edata = array();
		
		if(isset($_POST) && isset($_POST["loginadmin"]) && !empty($_POST["loginadmin"]))
		{
			$data = $this->input->post();
			$email = $data["email"];
			$password = $data["password"];

			$udata = array(
				"email" => $email,
				"password" => md5($password)
			);

			$userdata = $this->AdminModel->user_login($udata);

			if(!empty($userdata))
			{
				if($userdata["status"] == 1)
				{
					$this->session->set_userdata('cricwarm_admin', $userdata);
					$this->session->set_userdata("cricwarm_userID",$userdata["id"]);
					redirect(base_url().'admin/dashboard', 'refresh');
				}else
				{
					$edata['error'] = "You are blocked by admin!";						
				}
			}else
			{
				$edata['error'] = "Invalid usrername or password!";
			}
		}
		$this->load->view('index',$edata);
	}

	public function dashboard()
	{
		$this->load->view("header");
		$this->load->view("dashboard");
		$this->load->view("footer");
	}

	/*Nirbhay Start*/
	public function adduser($user_id = false)
	{

		$data = array();
		$data['user_data'] = "";
		$data['error'] = "";
		$data['email_error'] = "";
		$data['mobile_error'] = "";
		$data['pass_error'] = "";
		if(isset($_POST['submit']))
		{
			// print_r($_POST);
			// print_r($_FILES);

			$post_data = $_POST;
			if(isset($_POST['email']) && isset($_POST['mobile_no']) && isset($_POST['password']) && isset($_POST['cpassword']))
			{


				$email = $_POST['email'];
				$mobile_no = $_POST['mobile_no'];
				$password = md5($_POST['password']);
				$cpassword = md5($_POST['cpassword']);


				$check_email = $this->CommonModel->getWhereData('users',array('email'=>$email));
				$check_mobile = $this->CommonModel->getWhereData('users',array('mobile_no'=>$mobile_no));
				if(empty($check_email) && empty($check_mobile) && $password == $cpassword)
				{
					$insert_data = array();
					$insert_data['name'] = (!empty($_POST['name'])?$_POST['name']:'');
					$insert_data['email'] = $email;
					$insert_data['mobile_no'] = $mobile_no;
					$insert_data['password'] = $password;
					$insert_data['show_password'] = $password;
					$insert_data['address'] = $_POST['address'];
					$insert_data['language_id'] = $_POST['password'];
					$insert_data['latitude'] = (!empty($_POST['latitude'])?$_POST['latitude']:'');
					$insert_data['longitude'] = (!empty($_POST['longitude'])?$_POST['longitude']:'');
					$insert_data['userrole'] = 1;
					$insert_data['create_date'] = date('Y-m-d H:i:s');
					if(!empty($_FILES['image']['name']))
					{
			      		$ThumbSquareSize 		= 200; //Thumbnail will be 200x200

						$BigImageMaxSize 		= 1024; //Image Maximum height or width

						$ThumbPrefix			= "thumb_"; //Normal thumb Prefix

						$DestinationDirectory	= 'uploads/'; //Upload Directory ends with / (slash)

						$Quality 				= 60;



						//ini_set('memory_limit', '-1'); // maximum memory!



						

							// some information about image we need later.

							$ImageName = $_FILES['image']['name'];



							// die;

							$ImageSize 		= $_FILES['image']['size'];

							$TempSrc	 	= $_FILES['image']['tmp_name'];

							$ImageType	 	= $_FILES['image']['type'];

							$processImage			= true;	

							$RandomNumber			= time();  // We need same random name for both files.

							

							if(!isset($ImageName) || !is_uploaded_file($TempSrc))

							{

								// echo '<div class="error">Error occurred while trying to process <strong>'.$ImageName[$i].'</strong>, may be file too big!</div>'; //output error

							}

							else

							{

								//Validate file + create image from uploaded file.

								switch(strtolower($ImageType))

								{

									case 'image/png':

										$CreatedImage = imagecreatefrompng($TempSrc);

										break;

									case 'image/gif':

										$CreatedImage = imagecreatefromgif($TempSrc);

										break;

									case 'image/jpeg':

									case 'image/pjpeg':

										$CreatedImage = imagecreatefromjpeg($TempSrc);

										break;

									default:

										$processImage = false; //image format is not supported!

								}

								//get Image Size

								list($CurWidth,$CurHeight)=getimagesize($TempSrc);



								//Get file extension from Image name, this will be re-added after random name

								$ImageExt = substr($ImageName, strrpos($ImageName, '.'));

								$ImageExt = str_replace('.','',$ImageExt);

						

								//Construct a new image name (with random number added) for our new image.

								$NewImageName = $RandomNumber.'.'.$ImageExt;



								//Set the Destination Image path with Random Name

								$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name

								$DestRandImageName 			= $DestinationDirectory.$NewImageName; //Name for Big Image



								//Resize image to our Specified Size by calling resizeImage function.

								if($processImage && $this->resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))

								{

									$insert_data['image'] = base_url()."uploads/".$NewImageName;

								}else{

									// echo '<div class="error">Error occurred while trying to process <strong>'.$ImageName[$i].'</strong>! Please check if file is supported</div>'; //output error

								}

								

							}
					}
					$insert_data['reg_id'] = $this->createCode('users','reg_id');

					$result_id = $this->CommonModel->insertData('users',$insert_data);

			    	if(!empty($result_id))
			    	{
			    		// $user_data = $this->common_model->GetWhere('users',array('id'=>$result_id));
			    		$this->session->set_flashdata('success', 'Registration has been done successfully.');
			    		// $data['success'] = "Registration has been done successfully.";
			    		redirect(base_url()."admin/userlist");

			    	}
			    	else
			    	{
			    		$data['error'] = DATABASE_ERROR;
			    	}
				}
				elseif (!empty($check_email) && !empty($check_mobile) && $password != $cpassword) {
					$data['email_error'] = "Email already exist";
					$data['mobile_error'] = "Mobile no already exist";
					$data['pass_error'] = "Password not matched";
				}
				elseif(!empty($check_email) && !empty($check_mobile) && $password == $cpassword)
				{
					$data['email_error'] = "Email already exist";
					$data['mobile_error'] = "Mobile no already exist";
				}
				elseif(!empty($check_email) && empty($check_mobile) && $password == $cpassword)
				{
					$data['email_error'] = "Email already exist";
				}
				elseif(empty($check_email) && !empty($check_mobile) && $password == $cpassword)
				{
					$data['mobile_error'] = "Mobile no already exist";
				}
				elseif (empty($check_email) && empty($check_mobile) && $password != $cpassword) {
					$data['pass_error'] = "Password not matched";
				}
				else{

					$data['error'] = "Invalid detail please try again";
				}

				
			}
			else
			{
				$data['error'] = "Invalid detail please try again";
				
			}
			$data['user_data'] = $post_data;
			// die;
		}
		if(isset($_POST['update']))
		{
			// print_r($_POST);

			if(isset($_POST['email']) && isset($_POST['mobile_no']) && isset($_POST['id']) && !empty($_POST['email']) && !empty($_POST['mobile_no']) && !empty($_POST['id']))
			{

				$id = $_POST['id'];

				$email = $_POST['email'];
				$mobile_no = $_POST['mobile_no'];

				$check_email = $this->CommonModel->getWhereData('users',array('email'=> $email,'id !='=> $id));
				$check_mobile = $this->CommonModel->getWhereData('users',array('mobile_no'=>$mobile_no,'id !='=> $id));
				if(empty($check_email) && empty($check_mobile))
				{
					$update_data = array();
					$update_data['name'] = $_POST['name'];
					$update_data['email'] = $email;
					$update_data['mobile_no'] = $mobile_no;
					$update_data['address'] = $_POST['address'];
					$update_data['latitude'] = (!empty($_POST['latitude'])?$_POST['latitude']:'');
					$update_data['longitude'] = (!empty($_POST['longitude'])?$_POST['longitude']:'');
					if(!empty($_FILES['image']['name']))
					{
			      		$ThumbSquareSize 		= 200; //Thumbnail will be 200x200

						$BigImageMaxSize 		= 1024; //Image Maximum height or width

						$ThumbPrefix			= "thumb_"; //Normal thumb Prefix

						$DestinationDirectory	= 'uploads/'; //Upload Directory ends with / (slash)

						$Quality 				= 60;



						//ini_set('memory_limit', '-1'); // maximum memory!



						

							// some information about image we need later.

							$ImageName = $_FILES['image']['name'];



							// die;

							$ImageSize 		= $_FILES['image']['size'];

							$TempSrc	 	= $_FILES['image']['tmp_name'];

							$ImageType	 	= $_FILES['image']['type'];

							$processImage			= true;	

							$RandomNumber			= time();  // We need same random name for both files.

							

							if(!isset($ImageName) || !is_uploaded_file($TempSrc))

							{

								// echo '<div class="error">Error occurred while trying to process <strong>'.$ImageName[$i].'</strong>, may be file too big!</div>'; //output error

							}

							else

							{

								//Validate file + create image from uploaded file.

								switch(strtolower($ImageType))

								{

									case 'image/png':

										$CreatedImage = imagecreatefrompng($TempSrc);

										break;

									case 'image/gif':

										$CreatedImage = imagecreatefromgif($TempSrc);

										break;

									case 'image/jpeg':

									case 'image/pjpeg':

										$CreatedImage = imagecreatefromjpeg($TempSrc);

										break;

									default:

										$processImage = false; //image format is not supported!

								}

								//get Image Size

								list($CurWidth,$CurHeight)=getimagesize($TempSrc);



								//Get file extension from Image name, this will be re-added after random name

								$ImageExt = substr($ImageName, strrpos($ImageName, '.'));

								$ImageExt = str_replace('.','',$ImageExt);

						

								//Construct a new image name (with random number added) for our new image.

								$NewImageName = $RandomNumber.'.'.$ImageExt;



								//Set the Destination Image path with Random Name

								$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name

								$DestRandImageName 			= $DestinationDirectory.$NewImageName; //Name for Big Image



								//Resize image to our Specified Size by calling resizeImage function.

								if($processImage && $this->resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))

								{

									$update_data['image'] = base_url()."uploads/".$NewImageName;

								}else{

									// echo '<div class="error">Error occurred while trying to process <strong>'.$ImageName[$i].'</strong>! Please check if file is supported</div>'; //output error

								}

								

							}
					}

					$this->CommonModel->updateData('users',$update_data,array('id'=>$id));
					$this->session->set_flashdata('tour_success', __webtxt('User has been updated successfully'));
					redirect(base_url()."admin/userlist");

				}
				elseif(!empty($check_email) && !empty($check_mobile))
				{
					$data['email_error'] = "Email already exist";
					$data['mobile_error'] = "Mobile no already exist";
				}
				elseif(!empty($check_email))
				{
					$data['email_error'] = "Email already exist";
				}
				elseif(!empty($check_mobile))
				{
					$data['mobile_error'] = "Mobile no already exist";
				}
				else
				{
					$data['error'] = "Invalid details please try again";
				}

			}
			// die;
		}

		if(!empty($user_id))
		{
			$user_data = $this->AdminModel->getUserData($user_id);

			if(!empty($user_data))
			{
				$data["user_data"] = $user_data;
			}
			else
			{
				$this->session->set_flashdata('tour_error', __webtxt('Invalid user'));
				redirect(base_url()."admin/userlist");
			}
		}
		$data['userrole_data'] = $this->CommonModel->getWhereDataByOrder("userrole",array("status" => 1,'roleid !='=>1),"roleid","ASC");
		$this->load->view("header");
		$this->load->view("adduser",$data);
		$this->load->view("footer");
	}

	public function userlist()
	{
		$user_list = $this->CommonModel->getWhereDataByOrder("users",array("userrole" => 2,"status !=" => 3),"id","DESC");
		//p($user_list);

		$data = array();
		$data["user_list"] = $user_list;

		$this->load->view("header");
		$this->load->view("userlist",$data);
		$this->load->view("footer");
	}

	public function viewuser($id = false)
	{
		if(!empty($id))
		{
			$user_data = $this->AdminModel->getUserData($id);

			if(!empty($user_data))
			{
				
				$data = array();

				$data["user_data"] = $user_data;

				//p($user_data);

				$this->load->view("header");
				$this->load->view("viewuser",$data);
				$this->load->view("footer");	
			}else
			{
				$this->session->set_flashdata('tour_error', __webtxt('Invalid user'));
				redirect(base_url()."admin/userlist");
			}
		}else
		{
			$this->session->set_flashdata('tour_error', __webtxt('Invalid user'));
			redirect(base_url()."admin/userlist");
		}		
	}


	
	/* Ajax Functions Start */

	public function changestatus()
	{
		if($this->input->is_ajax_request())
		{
			$data = $this->input->post();
			$tabname = $data["tabname"];
			$status = $data["status"];
			$id = $data["id"];
			$useract = $data["useract"];
			$userrole = $data["userrole"];

			$this->CommonModel->updateData($tabname,array("status" => $status),array("id" => $id));

			$msg = "";

			if($userrole == 2)
			{
				$msg = __webtxt("User ".$useract." successfully.");
			}else if($userrole == 3)
			{
				$msg = __webtxt("Tipper ".$useract." successfully.");
			}
			else if($userrole == "tour")
			{
				$msg = "Tour ".$useract." successfully.";
			}
			else if($userrole == "destination")
			{
				$msg = "Destination ".$useract." successfully.";
			}

			$res = array("success" => 1,"msg" => $msg);

			sendResponse($res);
		}
	}

	/* Ajax Functions End */

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}


	public function uploadImages($ImageName,$ImageType,$TempSrc,$ImageSize)
	{
		$ThumbSquareSize 		= 200; //Thumbnail will be 200x200
		$BigImageMaxSize 		= 1024; //Image Maximum height or width
		$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
		$DestinationDirectory	= 'uploads/'; //Upload Directory ends with / (slash)
		$Quality 				= 60;

		// some information about image we need later.
		/*$ImageName = $img['tour_image']['name'];

		$ImageSize 		= $img['tour_image']['size'];

		$TempSrc	 	= $img['tour_image']['tmp_name'];

		$ImageType	 	= $img['tour_image']['type'];*/

		$processImage			= true;	

		$RandomNumber			= time().rand();  // We need same random name for both files.

		switch(strtolower($ImageType))
		{
			case 'image/png':
				$CreatedImage = imagecreatefrompng($TempSrc);
				break;

			case 'image/gif':
				$CreatedImage = imagecreatefromgif($TempSrc);
				break;

			case 'image/jpeg':

			case 'image/pjpeg':
				$CreatedImage = imagecreatefromjpeg($TempSrc);
				break;
			default:
				$processImage = false; //image format is not supported!
		}

		//get Image Size

		list($CurWidth,$CurHeight)=getimagesize($TempSrc);

		//Get file extension from Image name, this will be re-added after random name

		$Imagearray = explode(".", $ImageName);

		$ImageExt = array_pop($Imagearray);

		//Construct a new image name (with random number added) for our new image.
		$NewImageName = implode("_", $Imagearray)."_".$RandomNumber.'.'.$ImageExt;

		//Set the Destination Image path with Random Name
		$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name

		$DestRandImageName 			= $DestinationDirectory.$NewImageName; //Name for Big Image

		//Resize image to our Specified Size by calling resizeImage function.

		if($processImage && $this->resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
		{
			return $NewImageName;
		}else{
			return false;
		}
	}


	public function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
    {
    	//Check Image size is not 0
		if($CurWidth <= 0 || $CurHeight <= 0)
		{
				return false;

		}

		//Construct a proportional size of new image

		$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 

		$NewWidth  			= ceil($ImageScale*$CurWidth);

		$NewHeight 			= ceil($ImageScale*$CurHeight);

		

		if($CurWidth < $NewWidth || $CurHeight < $NewHeight)
		{
			$NewWidth = $CurWidth;
			$NewHeight = $CurHeight;

		}

		$NewCanves 	= imagecreatetruecolor($NewWidth, $NewHeight);

		// Resize Image

		if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))

		{

			switch(strtolower($ImageType))

			{

				case 'image/png':

					imagepng($NewCanves,$DestFolder);

					break;

				case 'image/gif':

					imagegif($NewCanves,$DestFolder);

					break;			

				case 'image/jpeg':

				case 'image/pjpeg':

					imagejpeg($NewCanves,$DestFolder,$Quality);

					break;

				default:

					return false;

			}

		if(is_resource($NewCanves)) { 

	      imagedestroy($NewCanves); 

	    } 

		return true;

		}
	}

	public function createCode($table,$column_name)
	{

        $jc = ""; 

        $jay = createRandomCode();

        $js = $this->CommonModel->getSingleData($table,array($column_name => $jay));

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
