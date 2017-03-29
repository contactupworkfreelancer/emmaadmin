<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	$this->load->model('adminuser','',TRUE);
	 $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');

}
	public function index()
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
				     $session_data = $this->session->userdata('logged_in');
				     $data['username'] = $session_data['username'];
				     $data['profile_url'] = $session_data['profile_url'];
				     $this->load->view('home', $data);



			   } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}


		public function addcity()
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
				     $session_data = $this->session->userdata('logged_in');
				     $data['username'] = $session_data['username'];
				     $data['profile_url'] = $session_data['profile_url'];
				     $data['countryList'] = $this->adminuser->fetchCountry();
			
				     $this->load->view('addcity', $data);
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}


    	public function cityList()
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
				     $session_data = $this->session->userdata('logged_in');
				     $data['username'] = $session_data['username'];
				     $data['profile_url'] = $session_data['profile_url'];
				     $data['cityData'] = $this->adminuser->fetchCity();
				     $data['countryList'] = $this->adminuser->fetchCountry();
			         
			         //echo "<pre> Data : ".print_r($data , TRUE )."</pre>";
			        // die();
				     $this->load->view('citylist', $data);
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}
		
		public function categorylist()
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
				     $session_data = $this->session->userdata('logged_in');
				     $data['username'] = $session_data['username'];
				     $data['profile_url'] = $session_data['profile_url'];
				     $data['categoryData'] = $this->adminuser->fetchCategory();
			         
			         //echo "<pre> Data : ".print_r($data , TRUE )."</pre>";
			        // die();
				     $this->load->view('categorylist', $data);
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}
		
		
		public function addcategory()
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
				     $session_data = $this->session->userdata('logged_in');
				     $data['username'] = $session_data['username'];
				     $data['profile_url'] = $session_data['profile_url'];
				     $data['countryList'] = $this->adminuser->fetchCountry();
			
				     $this->load->view('addcategory', $data);
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}



			public function fetchState()
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
		       // echo "<pre> Data : ".print_r($_REQUEST , TRUE )."</pre>";
		     //   die();
				   $data = $this->adminuser->fetchState($_REQUEST['country']);
                   header('Content-Type: application/json');
                   echo json_encode( $data );
				  // echo "<pre> Data : ".print_r($data , TRUE )."</pre>";
                   
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}


     public function saveCity()
	
	{
		//echo "<pre> Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
		if($this->session->userdata('logged_in'))
     {
			
			$newcity = $this->input->post('city');
			$newstate = $this->input->post('state');
			$newcountry = $this->input->post('country');
			$newzipcode = $this->input->post('zipcode');
			$newstatus = "1";
			$data =array('city'=>$newcity,
				         'state_id'=>$newstate,
				         'country_id' => $newcountry,
				         'zipcode' => $newzipcode,
				         'status' => $newstatus);
            
           // echo "<pre> Data : ".print_r($data , TRUE)."</pre>";
            $this->adminuser->insertCity($data);
            redirect('/home/cityList');
                   
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }

		}
	public function do_upload() { 


         $config['upload_path']   = '/var/www/html/admin/uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $imageName = '';
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload('userfile')) {
         	//echo "<pre> Data : ".print_r($this->upload->display_errors() , TRUE)."</pre>";
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('addcategory', $error); 
         }
			
         else { 
            $data = array('upload_data' => $this->upload->data()); 
            
           // echo "<pre> Data : ".print_r($data['upload_data']['file_name'] , TRUE )."</pre>";

            if($this->session->userdata('logged_in'))
     {
	        $image = $data['upload_data']['file_name'];		
			$newname = $this->input->post('name');
			$newstatus = "1";
			$data =array('name'=>$newname,'status' => $newstatus,'image' => $image );
            
          ///  echo "<pre> Data : ".print_r($data , TRUE)."</pre>";
            $this->adminuser->insertName($data);
             redirect('Home/cityList'); 
                   
               } else {
			     //If no session, redirect to login page
			    $this->load->view('welcome_message');
			   }
         }

         die();



		 
      }
	  
	  
	function updatecity() {
 
            
           if($this->session->userdata('logged_in'))
           {  
                $updated_data = array(  
                     'country_id'          =>     $this->input->post('country'),  
                     'state_id'               =>     $this->input->post('state'),
                     'city'               =>     $this->input->post('city'),
                     'zipcode'               =>     $this->input->post('zipcode'),
					 'status'               =>  $this->input->post('status')
					 );  
                $this->load->model('Adminuser');  
                $this->adminuser->updatecity($this->input->post("cityid"), $updated_data);  
               redirect('Home/cityList'); 
           }
	  
	}
	  
	  
	  
	  
	  
	  public function deletecity() { 
	  	 $city = $this->input->post('id');
         $this->load->model('Adminuser'); 
        
         $this->Adminuser->deletecity($city); 
         //redirect('/home/cityList');

      } 

      public function fetchcityData() { 
	  	 $city = $this->input->post('id');
         $this->load->model('Adminuser'); 
        
        $data['city'] = $this->Adminuser->fetchcityData($city);
       // echo "<pre> Data : ".print_r($data['city'] , TRUE)."</pre>";
         $data['citylist'] = $this->adminuser->fetchState($data['city'][0]->country_id);
                   header('Content-Type: application/json');
                   echo json_encode( $data );
        die(); 
       // $data['citylist'] = $this->Adminuser->fetchcityData($city); 
         //redirect('/home/cityList');

      } 
	  
}