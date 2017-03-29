<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('adminuser','',TRUE);
   $this->load->library('session');
   $this->load->helper('form');
   $this->load->helper('url');
 }

 function login_user()
 {
   //Field validation succeeded.  Validate against database
   echo "<pre> post :".print_r($this->input->post() , TRUE )."</pre>";
   $emailid = $this->input->post('email_id');
   $password = $this->input->post('password');

   //query the database
   $result = $this->adminuser->login($emailid, $password);
 echo "<pre> result : ".print_r($result , TRUE)."</pre>";

//die();

   if($result)
   {
     $sess_array = array();

     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username,
         'profile_url' => $row->image
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
    // echo "<pre> Session Data :".print_r($this->session->userdata('logged_in') , TRUE )."</pre>";
     //die();
   redirect('/');
   }
   else
   {
    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect('/');
     ///return false;
   }
 }
}
?>
